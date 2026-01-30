pipeline {
    agent any
    
    // 🔐 Production Approval
    options {
        timeout(time: 1, unit: 'HOURS')
        buildDiscarder(logRotator(numToKeepStr: '30'))
        disableConcurrentBuilds()
    }
    
    parameters {
        booleanParam(name: 'deployStaging', defaultValue: false, description: 'Deploy to Staging?')
        booleanParam(name: 'deployProduction', defaultValue: false, description: 'Deploy to Production? (Requires Approval)')
    }
    
    environment {
        DOCKER_IMAGE = "ghcr.io/${GIT_USERNAME}/taskmanager"
        DOCKER_TAG = "${BUILD_NUMBER}"
        COMPOSER_CACHE = "${WORKSPACE}/vendor"
    }
    
    stages {
        stage('🔍 Checkout') {
            steps {
                checkout scm
                script {
                    env.GIT_COMMIT_SHORT = sh(script: 'git rev-parse --short HEAD', returnStdout: true).trim()
                }
            }
        }
        
        stage('🧪 Test & Quality') {
            parallel {
                stage('🐘 PHP Lint & Composer') {
                    agent {
                        docker {
                            image 'php:8.3-cli-alpine'
                            args '-u root'
                        }
                    }
                    steps {
                        sh 'composer validate'
                        sh 'composer install --no-progress --no-interaction'
                        sh 'vendor/bin/phpstan analyze --level=8 app'
                        sh 'vendor/bin/php-cs-fixer fix --dry-run --diff'
                    }
                }
                
                stage('🧪 PHPUnit Tests') {
                    agent {
                        docker {
                            image 'mariadb:11.4'
                            alias 'mariadb'
                        }
                    }
                    steps {
                        sh '''
                            cp .env.example .env
                            echo "database.default.hostname = mariadb" >> .env
                            php spark test --coverage-html coverage
                        '''
                    }
                }
                
                stage('🐳 Docker Build') {
                    steps {
                        script {
                            dockerImage = docker.build("${DOCKER_IMAGE}:${DOCKER_TAG}")
                        }
                    }
                }
            }
        }
        
        stage('🛡️ Security Scan') {
            steps {
                sh 'composer audit'
                sh 'vendor/bin/security-check'
            }
        }
        
        stage('🚀 Deploy Staging') {
            when { expression { params.deployStaging } }
            steps {
                sshagent(['staging-ssh']) {
                    sh '''
                        ssh staging.server.com << EOF
                            cd /var/www/taskmanager-staging
                            docker-compose pull
                            docker-compose up -d
                            docker-compose exec app php spark migrate
                        EOF
                    '''
                }
            }
        }
        
        stage('🎯 Production Approval') {
            when { 
                allOf {
                    expression { params.deployProduction }
                    expression { env.BRANCH_NAME == 'main' }
                }
            }
            steps {
                input message: 'Deploy to Production?', ok: '🚀 Deploy'
            }
        }
        
        stage('🎯 Deploy Production') {
            when { expression { params.deployProduction } }
            steps {
                sshagent(['prod-ssh']) {
                    sh '''
                        ssh prod.server.com << EOF
                            docker pull ${DOCKER_IMAGE}:${DOCKER_TAG}
                            kubectl set image deployment/taskmanager app=${DOCKER_IMAGE}:${DOCKER_TAG}
                            kubectl rollout status deployment/taskmanager
                        EOF
                    '''
                }
            }
            post {
                success {
                    slackSend(
                        color: 'good',
                        message: "🎉 TaskManager ${BUILD_NUMBER} deployed to Production! ${env.JOB_URL}"
                    )
                }
            }
        }
    }
    
    post {
        always {
            junit 'tests/_output/junit.xml'
            publishHTML([
                allowMissing: false,
                alwaysLinkToLastBuild: true,
                keepAll: true,
                reportDir: 'tests/_output',
                reportFiles: 'index.html',
                reportName: 'PHPUnit Coverage'
            ])
            publishHTML([
                allowMissing: false,
                alwaysLinkToLastBuild: true,
                keepAll: true,
                reportDir: 'coverage',
                reportFiles: 'index.html',
                reportName: 'Code Coverage'
            ])
        }
        cleanup {
            sh 'docker system prune -f'
            cleanWs()
        }
    }
}
