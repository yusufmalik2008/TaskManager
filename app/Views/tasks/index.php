<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>TaskMaster Pro - My Tasks</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: { "primary": "#7f13ec", "primary-hover": "#6b11c7" },
                    fontFamily: { "display": ["Inter", "sans-serif"] },
                    borderRadius: {"xl": "0.75rem", "2xl": "1rem"}
                }
            }
        }
    </script>
    <style>
        .glass-card { 
            background: rgba(255,255,255,0.1); 
            backdrop-filter: blur(16px); 
            border: 1px solid rgba(255,255,255,0.2); 
        }
        .glass-panel { 
            background: rgba(255,255,255,0.05); 
            backdrop-filter: blur(10px); 
            border: 1px solid rgba(255,255,255,0.1); 
        }
        @media (prefers-color-scheme: dark) {
            .dark\:bg-slate-900 { background-color: #0f172a; }
        }
    </style>
</head>
<body class="font-display bg-slate-50 dark:bg-[#0B1120] text-slate-900 dark:text-slate-100 antialiased min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="hidden lg:flex w-64 flex-col border-r border-slate-200/50 dark:border-slate-800/60 glass-panel shadow-2xl">
            <div class="flex h-20 items-center gap-3 px-6 border-b border-slate-100/50 dark:border-slate-800/60">
                <div class="bg-primary/20 p-2 rounded-xl">
                    <span class="material-symbols-outlined text-primary text-xl">dataset</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold dark:text-white">TaskMaster</h1>
                    <p class="text-primary text-xs font-semibold">Pro Plan</p>
                </div>
            </div>
            <nav class="flex-1 p-6 space-y-2">
                <a href="<?= site_url('dashboard') ?>" class="flex items-center gap-3 rounded-xl px-4 py-3 text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800 transition-all">
                    <span class="material-symbols-outlined">grid_view</span> Dashboard
                </a>
                <a href="<?= site_url('tasks') ?>" class="flex items-center gap-3 rounded-xl bg-primary/20 px-4 py-3 text-primary font-semibold shadow-sm">
                    <span class="material-symbols-outlined font-bold">check_box</span> My Tasks
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 lg:p-8 overflow-auto">
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold tracking-tight text-slate-900 dark:text-white mb-2">
                            <span class="material-symbols-outlined text-primary mr-3 text-4xl align-middle">task_alt</span>
                            My Tasks
                        </h1>
                        <p class="text-slate-500 dark:text-slate-400 text-lg">Manage your daily activities efficiently</p>
                    </div>
                    <a href="<?= site_url('tasks/create') ?>" class="group flex items-center gap-2 bg-primary hover:bg-primary-hover text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-primary/25 transition-all group-hover:shadow-primary/40 group-hover:-translate-y-0.5">
                        <span class="material-symbols-outlined text-xl">add</span>
                        Add New Task
                    </a>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="glass-card rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all group border border-slate-100/50 dark:border-slate-700/50">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">Pending Tasks</p>
                                <h3 class="text-4xl font-bold text-slate-900 dark:text-white"><?= count($pendingTasks ?? []) ?></h3>
                            </div>
                            <div class="size-20 flex items-center justify-center bg-yellow-100/50 dark:bg-yellow-900/30 text-yellow-600 rounded-2xl group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl">pending_actions</span>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all group border border-slate-100/50 dark:border-slate-700/50">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">In Progress</p>
                                <h3 class="text-4xl font-bold text-slate-900 dark:text-white"><?= count($inProgressTasks ?? []) ?></h3>
                            </div>
                            <div class="size-20 flex items-center justify-center bg-blue-100/50 dark:bg-blue-900/30 text-blue-600 rounded-2xl group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl">autorenew</span>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all group border border-slate-100/50 dark:border-slate-700/50">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">Completed</p>
                                <h3 class="text-4xl font-bold text-slate-900 dark:text-white"><?= count($completedTasks ?? []) ?></h3>
                            </div>
                            <div class="size-20 flex items-center justify-center bg-emerald-100/50 dark:bg-emerald-900/30 text-emerald-600 rounded-2xl group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-3xl">check_circle</span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (empty($tasks)): ?>
                <!-- Empty State -->
                <div class="text-center py-20 glass-card rounded-3xl max-w-2xl mx-auto">
                    <div class="w-32 h-32 bg-gradient-to-r from-primary/20 to-purple-500/20 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl">
                        <span class="material-symbols-outlined text-6xl text-primary">task_alt</span>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">No tasks yet</h2>
                    <p class="text-xl text-slate-500 dark:text-slate-400 mb-8">Get started by creating your first task!</p>
                    <a href="<?= site_url('tasks/create') ?>" class="inline-flex items-center gap-3 bg-gradient-to-r from-primary to-purple-600 hover:from-primary-hover hover:to-purple-700 text-white px-8 py-4 rounded-2xl font-bold shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:-translate-y-1">
                        <span class="material-symbols-outlined text-xl">add_circle</span>
                        Create First Task
                    </a>
                </div>
                <?php else: ?>
                <!-- Tasks Grid -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Current Tasks (<?= count($tasks) ?>)</h2>
                        <div class="glass-panel rounded-xl px-4 py-2">
                            <select class="bg-transparent text-sm font-semibold text-slate-900 dark:text-white border-none focus:ring-0 cursor-pointer">
                                <option>All Priorities</option>
                                <option>High Priority</option>
                                <option>Medium Priority</option>
                                <option>Low Priority</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach($tasks as $task): 
                            $priorityClass = $task['priority'] === 'high' ? 'bg-red-50 dark:bg-red-950/50 border-red-200 text-red-700' : 
                                            ($task['priority'] === 'medium' ? 'bg-amber-50 dark:bg-amber-950/50 border-amber-200 text-amber-700' : 
                                            'bg-emerald-50 dark:bg-emerald-950/50 border-emerald-200 text-emerald-700');
                            $priorityBorder = $task['priority'] === 'high' ? 'left-red-500' : 
                                            ($task['priority'] === 'medium' ? 'left-amber-500' : 'left-emerald-500');
                        ?>
                        <article class="group relative glass-card rounded-2xl p-0 shadow-lg hover:shadow-2xl border hover:border-slate-300 dark:border-slate-700/50 hover:-translate-y-2 transition-all duration-300 overflow-hidden h-full">
                            <!-- Priority Bar -->
                            <div class="absolute left-0 top-0 bottom-0 w-2 bg-gradient-to-b <?= $priorityBorder === 'left-red-500' ? 'from-red-500 to-red-600' : ($priorityBorder === 'left-amber-500' ? 'from-amber-500 to-amber-600' : 'from-emerald-500 to-emerald-600') ?>"></div>
                            
                            <div class="p-7">
                                <div class="flex justify-between items-start mb-4">
                                    <span class="<?= $priorityClass ?> border-2 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm"><?= ucfirst($task['priority']) ?> Priority</span>
                                    <span class="text-xs font-medium text-slate-400 dark:text-slate-500">ID: <?= $task['id'] ?></span>
                                </div>
                                
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3 leading-tight group-hover:text-primary transition-colors line-clamp-2"><?= esc($task['title']) ?></h3>
                                
                                <p class="text-slate-600 dark:text-slate-400 mb-6 leading-relaxed line-clamp-3"><?= esc($task['description'] ?: 'No description provided') ?></p>
                            </div>
                            
                            <!-- Action Bar -->
                            <div class="border-t border-slate-100/50 dark:border-slate-700/50 px-7 py-5 bg-slate-50/70 dark:bg-slate-800/50 backdrop-blur-sm">
                                <div class="flex items-center justify-between">
                                    <div class="flex -space-x-2">
                                        <div class="size-10 rounded-full bg-gradient-to-r from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-600 shadow-lg"></div>
                                    </div>
                                    <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-x-3 group-hover:translate-x-0">
                                        <a href="<?= site_url('tasks/edit/' . $task['id']) ?>" class="p-3 rounded-xl text-slate-400 hover:text-primary hover:bg-primary/10 transition-all shadow-sm hover:shadow-md" title="Edit Task">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </a>
                                        <a href="<?= site_url('tasks/delete/' . $task['id']) ?>" class="p-3 rounded-xl text-slate-400 hover:text-red-500 hover:bg-red-500/10 transition-all shadow-sm hover:shadow-md" title="Delete Task" onclick="return confirm('Are you sure you want to delete this task?')">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
