<!DOCTYPE html>
<html class="dark" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Elite Task Dashboard - Glassmorphism</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#1121d4",
                    "background-light": "#f6f6f8",
                    "background-dark": "#0f111a",
                    "glass-surface": "rgba(255, 255, 255, 0.03)",
                    "glass-border": "rgba(255, 255, 255, 0.08)",
                },
                fontFamily: {
                    "display": ["Inter", "sans-serif"]
                },
                borderRadius: {"DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "2xl": "2rem", "full": "9999px"},
                backgroundImage: {
                    'gradient-glow': 'radial-gradient(circle at 50% 0%, rgba(17, 33, 212, 0.15), transparent 70%)',
                    'card-gradient': 'linear-gradient(145deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.01) 100%)'
                }
            },
        },
    }
</script>
<style>
    .glass-panel {
        background: rgba(30, 32, 45, 0.4);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    }
    
    .glass-sidebar {
        background: rgba(16, 18, 34, 0.6);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-right: 1px solid rgba(255, 255, 255, 0.05);
    }

    .glass-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.01) 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
    }
    
    .ambient-bg {
        background-color: #0f111a;
        position: relative;
        overflow: hidden;
    }
    .ambient-bg::before {
        content: '';
        position: absolute;
        top: -20%;
        left: -10%;
        width: 60%;
        height: 60%;
        background: radial-gradient(circle, rgba(17, 33, 212, 0.15) 0%, transparent 60%);
        border-radius: 50%;
        z-index: 0;
        filter: blur(80px);
    }
    .ambient-bg::after {
        content: '';
        position: absolute;
        bottom: -10%;
        right: -10%;
        width: 50%;
        height: 50%;
        background: radial-gradient(circle, rgba(11, 218, 101, 0.05) 0%, transparent 60%);
        border-radius: 50%;
        z-index: 0;
        filter: blur(80px);
    }
    
    ::-webkit-scrollbar {
        width: 6px;
    }
    ::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.02);
    }
    ::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.2);
    }
</style>
</head>
<body class="font-display antialiased text-white bg-background-dark ambient-bg min-h-screen flex">

<?php
// Backend data - PHP variables (keep your existing PHP logic here)
$totalTasks = 128;
$pendingTasks = 12;
$inProgressTasks = 5;
$completedTasks = 89;
$completionRate = 94;
$tasksCompletedWeek = 42;

// Dynamic user data
$userName = "Alex";
$currentMonth = date('F Y'); // January 2026

// Recent tasks array (your PHP backend data)
$recentTasks = [
    [
        'title' => 'Redesign Homepage',
        'category' => 'Marketing Website',
        'priority' => 'High Priority',
        'due_date' => 'Due Tomorrow',
        'progress' => 75,
        'assignees' => 2
    ],
    [
        'title' => 'Client Meeting Prep',
        'category' => 'Sales Strategy',
        'priority' => 'Medium',
        'due_date' => 'Fri, Jan 30',
        'progress' => 30,
        'assignees' => 1
    ],
    [
        'title' => 'Q1 Financial Report',
        'category' => 'Finance & Admin',
        'priority' => 'Low Priority',
        'due_date' => 'Next Week',
        'progress' => 0,
        'assignees' => 2
    ]
];
?>

<!-- Sidebar (EXACT original design) -->
<aside class="glass-sidebar w-72 h-screen flex flex-col justify-between p-6 fixed z-50 transition-all duration-300 left-0 top-0">
<div class="flex flex-col gap-8">
<!-- Branding -->
<div class="flex items-center gap-3 px-2">
<div class="bg-primary aspect-square rounded-xl size-10 flex items-center justify-center shadow-lg shadow-primary/30">
<span class="material-symbols-outlined text-white text-[24px]">dataset</span>
</div>
<div class="flex flex-col">
<h1 class="text-white text-lg font-bold tracking-tight">TaskMaster</h1>
<p class="text-slate-400 text-xs font-medium">Premium Edition</p>
</div>
</div>
<!-- Navigation -->
<nav class="flex flex-col gap-2">
<a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary/20 border border-primary/20 text-white shadow-lg shadow-primary/10 transition-all hover:translate-x-1" href="#">
<span class="material-symbols-outlined filled">grid_view</span>
<span class="text-sm font-medium">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all hover:translate-x-1" href="<?= site_url('projects') ?>">
<span class="material-symbols-outlined">folder_open</span>
<span class="text-sm font-medium">Projects</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all hover:translate-x-1" href="<?= site_url('tasks') ?>">
<span class="material-symbols-outlined">calendar_month</span>
<span class="text-sm font-medium">Tasks</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all hover:translate-x-1" href="<?= site_url('tasks') ?>">
<span class="material-symbols-outlined">chat_bubble_outline</span>
<span class="text-sm font-medium">Messages</span>
<span class="ml-auto bg-primary text-xs font-bold px-2 py-0.5 rounded-full">3</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all hover:translate-x-1" href="#">
<span class="material-symbols-outlined">analytics</span>
<span class="text-sm font-medium">Reports</span>
</a>
</nav>
</div>
<div class="flex flex-col gap-4">
<!-- User Profile -->
<div class="pt-6 border-t border-white/10">
<a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all" href="#">
<span class="material-symbols-outlined">settings</span>
<span class="text-sm font-medium">Settings</span>
</a>
</div>
<button class="w-full flex items-center justify-center gap-2 rounded-xl h-12 bg-primary hover:bg-primary/90 text-white text-sm font-bold tracking-wide shadow-lg shadow-primary/25 transition-all active:scale-95" >
<span class="material-symbols-outlined text-[20px]">add</span>
<span>New Project</span>
</button>
</div>
</aside>

<!-- Main Content (EXACT original layout) -->
<main class="flex-1 ml-72 h-screen overflow-y-auto relative z-10 p-8 xl:p-12">
<div class="max-w-7xl mx-auto flex flex-col gap-8">
<!-- Header (PHP dynamic data) -->
<header class="flex flex-wrap justify-between items-center gap-4">
<div>
<h2 class="text-3xl font-bold text-white tracking-tight mb-1">Welcome back, <?= htmlspecialchars($userName) ?></h2>
<p class="text-slate-400 text-sm">Here's your daily productivity overview</p>
</div>
<div class="flex items-center gap-4">
<!-- Search -->
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-slate-500 text-[20px]">search</span>
</div>
<input class="block w-64 pl-10 pr-3 py-2.5 bg-white/5 border border-white/10 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all glass-panel" placeholder="Search tasks..." type="text"/>
</div>
<!-- Notification -->
<button class="size-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:text-white hover:bg-white/10 transition-colors glass-panel relative">
<span class="absolute top-2.5 right-3 size-2 bg-red-500 rounded-full"></span>
<span class="material-symbols-outlined text-[20px]">notifications</span>
</button>
<!-- Profile Avatar -->
<div class="size-10 rounded-full bg-gradient-to-r from-primary to-indigo-500 flex items-center justify-center text-white font-bold text-sm border-2 border-white/10 cursor-pointer shadow-lg"><?= strtoupper(substr($userName, 0, 1)) ?></div>
</div>
</header>

<!-- Stats Grid (PHP dynamic data) -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- Stat Card 1 - Tasks Pending -->
<div class="glass-card rounded-2xl p-6 flex flex-col gap-4 relative overflow-hidden group hover:bg-white/10 transition-colors">
<div class="flex justify-between items-start">
<div class="p-2.5 rounded-lg bg-indigo-500/20 text-indigo-400">
<span class="material-symbols-outlined">pending_actions</span>
</div>
<span class="flex items-center gap-1 text-xs font-medium text-emerald-400 bg-emerald-500/10 px-2 py-1 rounded-full border border-emerald-500/20">
<span class="material-symbols-outlined text-[14px]">trending_up</span>
+12%
</span>
</div>
<div>
<p class="text-slate-400 text-sm font-medium mb-1">Tasks Pending</p>
<h3 class="text-3xl font-bold text-white"><?= $pendingTasks ?></h3>
</div>
<div class="absolute -bottom-10 -right-10 w-32 h-32 bg-indigo-500/20 rounded-full blur-3xl group-hover:bg-indigo-500/30 transition-all"></div>
</div>

<!-- Stat Card 2 - In Progress -->
<div class="glass-card rounded-2xl p-6 flex flex-col gap-4 relative overflow-hidden group hover:bg-white/10 transition-colors">
<div class="flex justify-between items-start">
<div class="p-2.5 rounded-lg bg-amber-500/20 text-amber-400">
<span class="material-symbols-outlined">autorenew</span>
</div>
<span class="flex items-center gap-1 text-xs font-medium text-amber-400 bg-amber-500/10 px-2 py-1 rounded-full border border-amber-500/20">
<span class="material-symbols-outlined text-[14px]">remove</span>
0%
</span>
</div>
<div>
<p class="text-slate-400 text-sm font-medium mb-1">In Progress</p>
<h3 class="text-3xl font-bold text-white"><?= $inProgressTasks ?></h3>
</div>
<div class="absolute -bottom-10 -right-10 w-32 h-32 bg-amber-500/20 rounded-full blur-3xl group-hover:bg-amber-500/30 transition-all"></div>
</div>

<!-- Stat Card 3 - Efficiency Rate -->
<div class="glass-card rounded-2xl p-6 flex flex-col gap-4 relative overflow-hidden group hover:bg-white/10 transition-colors">
<div class="flex justify-between items-start">
<div class="p-2.5 rounded-lg bg-primary/20 text-primary">
<span class="material-symbols-outlined">check_circle</span>
</div>
<span class="flex items-center gap-1 text-xs font-medium text-emerald-400 bg-emerald-500/10 px-2 py-1 rounded-full border border-emerald-500/20">
<span class="material-symbols-outlined text-[14px]">trending_up</span>
+24%
</span>
</div>
<div>
<p class="text-slate-400 text-sm font-medium mb-1">Efficiency Rate</p>
<h3 class="text-3xl font-bold text-white"><?= $completionRate ?>%</h3>
</div>
<div class="absolute -bottom-10 -right-10 w-32 h-32 bg-primary/20 rounded-full blur-3xl group-hover:bg-primary/30 transition-all"></div>
</div>
</section>

<!-- Main Split Layout (EXACT original) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-full min-h-[400px]">
<!-- Chart Section (PHP dynamic data) -->
<div class="glass-card lg:col-span-2 rounded-2xl p-6 flex flex-col min-h-[360px]">
<div class="flex justify-between items-center mb-6">
<div>
<h3 class="text-lg font-bold text-white">Weekly Activity</h3>
<p class="text-slate-400 text-sm"><?= $tasksCompletedWeek ?> Tasks completed this week</p>
</div>
<select class="bg-white/5 border border-white/10 text-slate-300 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2 outline-none cursor-pointer hover:bg-white/10 transition-colors">
<option>This Week</option>
<option>Last Week</option>
<option>Last Month</option>
</select>
</div>
<!-- Chart SVG (original exact design) -->
<div class="flex-1 w-full h-full relative flex items-end pb-4 px-2">
<div class="absolute inset-0 flex flex-col justify-between pointer-events-none" style="padding-bottom: 2rem;">
<div class="border-b border-white/5 w-full h-full"></div>
<div class="border-b border-white/5 w-full h-full"></div>
<div class="border-b border-white/5 w-full h-full"></div>
<div class="border-b border-white/5 w-full h-full"></div>
<div class="border-b border-white/5 w-full h-full"></div>
</div>
<svg class="w-full h-[220px] z-10 overflow-visible" preserveaspectratio="none" viewbox="0 0 800 220">
<defs>
<linearGradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
<stop offset="0%" stop-color="#1121d4" stop-opacity="0.4"></stop>
<stop offset="100%" stop-color="#1121d4" stop-opacity="0"></stop>
</linearGradient>
</defs>
<path d="M0,220 L0,150 C80,140 120,60 200,90 C280,120 320,160 400,140 C480,120 520,40 600,60 C680,80 720,120 800,100 L800,220 Z" fill="url(#chartGradient)"></path>
<path d="M0,150 C80,140 120,60 200,90 C280,120 320,160 400,140 C480,120 520,40 600,60 C680,80 720,120 800,100" fill="none" filter="drop-shadow(0px 4px 6px rgba(17, 33, 212, 0.4))" stroke="#1121d4" stroke-linecap="round" stroke-width="3"></path>
<circle cx="200" cy="90" fill="#fff" r="4" stroke="#1121d4" stroke-width="2"></circle>
<circle cx="400" cy="140" fill="#fff" r="4" stroke="#1121d4" stroke-width="2"></circle>
<circle cx="600" cy="60" fill="#fff" r="4" stroke="#1121d4" stroke-width="2"></circle>
</svg>
</div>
<div class="flex justify-between text-xs text-slate-500 font-medium px-1 mt-2">
<span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
</div>
</div>

<!-- Right Side Widgets (Calendar) -->
<div class="flex flex-col gap-6 lg:col-span-1">
<div class="glass-card rounded-2xl p-6 flex flex-col gap-4">
<div class="flex justify-between items-center">
<h3 class="text-md font-bold text-white"><?= $currentMonth ?></h3>
<div class="flex gap-2">
<button class="size-6 flex items-center justify-center rounded-full hover:bg-white/10 text-slate-400">
<span class="material-symbols-outlined text-[16px]">chevron_left</span>
</button>
<button class="size-6 flex items-center justify-center rounded-full hover:bg-white/10 text-slate-400">
<span class="material-symbols-outlined text-[16px]">chevron_right</span>
</button>
</div>
</div>
<div class="grid grid-cols-7 gap-1 text-center">
<div class="text-[10px] text-slate-500 font-bold uppercase py-1">S</div>
<div class="text-[10px] text-slate-500 font-bold uppercase py-1">M</div>
<div class="text-[10px] text-slate-500 font-bold uppercase py-1">T</div>
<div class="text-[10px] text-slate-500 font-bold uppercase py-1">W</div>
<div class="text-[10px] text-slate-500 font-bold uppercase py-1">T</div>
<div class="text-[10px] text-slate-500 font-bold uppercase py-1">F</div>
<div class="text-[10px] text-slate-500 font-bold uppercase py-1">S</div>
<!-- Dynamic calendar days -->
<div class="aspect-square flex items-center justify-center text-xs text-slate-600">28</div>
<div class="aspect-square flex items-center justify-center text-xs text-slate-600">29</div>
<div class="aspect-square flex items-center justify-center text-xs text-slate-600">30</div>
<div class="aspect-square flex items-center justify-center text-xs text-white">31</div>
<div class="aspect-square flex items-center justify-center text-xs text-white bg-primary rounded-lg shadow-lg shadow-primary/40">1</div>
<div class="aspect-square flex items-center justify-center text-xs text-white">2</div>
<div class="aspect-square flex items-center justify-center text-xs text-white">3</div>
<div class="aspect-square flex items-center justify-center text-xs text-white">4</div>
<div class="aspect-square flex items-center justify-center text-xs text-white">5</div>
<div class="aspect-square flex items-center justify-center text-xs text-white">6</div>
<div class="aspect-square flex items-center justify-center text-xs text-white">7</div>
</div>
</div>
</div>
</div>

<!-- Recent Tasks List (PHP dynamic loop) -->
<section class="glass-card rounded-2xl p-6 flex flex-col gap-6 mb-8">
<div class="flex items-center justify-between">
<h2 class="text-lg font-bold text-white">Recent Tasks</h2>
<a href="#" class="text-primary text-sm font-medium hover:text-white transition-colors">View All</a>
</div>
<div class="flex flex-col gap-3">
<?php foreach($recentTasks as $task): ?>
<div class="group flex flex-wrap md:flex-nowrap items-center gap-4 p-4 rounded-xl bg-white/5 border border-transparent hover:border-white/10 hover:bg-white/10 transition-all cursor-pointer">
<div class="flex items-center gap-4 flex-1 min-w-[200px]">
<div class="bg-primary/20 p-2 rounded-lg text-primary group-hover:bg-primary group-hover:text-white transition-colors">
<span class="material-symbols-outlined">design_services</span>
</div>
<div class="flex flex-col">
<h4 class="text-sm font-semibold text-white"><?= htmlspecialchars($task['title']) ?></h4>
<span class="text-xs text-slate-400"><?= htmlspecialchars($task['category']) ?></span>
</div>
</div>
<div class="w-[120px] shrink-0">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
<?php 
$priorityClass = strtolower(str_replace(' ', '-', $task['priority']));
echo $priorityClass == 'high-priority' ? 'bg-red-500/10 text-red-400 border-red-500/20' : 
     ($priorityClass == 'medium' ? 'bg-amber-500/10 text-amber-400 border-amber-500/20' : 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20');
?>">
<?= htmlspecialchars($task['priority']) ?>
</span>
</div>
<div class="flex items-center gap-2 w-[140px] shrink-0 text-slate-300 text-sm">
<span class="material-symbols-outlined text-[16px]">calendar_today</span>
<span><?= htmlspecialchars($task['due_date']) ?></span>
</div>
<div class="flex -space-x-2 w-[100px] shrink-0">
<div class="size-8 rounded-full border-2 border-[#1e202d] bg-gradient-to-r from-indigo-500 to-blue-500 flex items-center justify-center text-[10px] font-bold text-white">J</div>
<?php if($task['assignees'] > 1): ?>
<div class="size-8 rounded-full border-2 border-[#1e202d] bg-gradient-to-r from-pink-500 to-purple-500 flex items-center justify-center text-[10px] font-bold text-white">S</div>
<div class="size-8 rounded-full border-2 border-[#1e202d] bg-slate-700 flex items-center justify-center text-[10px] font-bold text-white">+<?= $task['assignees']-2 ?></div>
<?php endif; ?>
</div>
<div class="flex flex-col gap-1 w-[160px] shrink-0">
<div class="flex justify-between text-xs">
<span class="text-slate-400">Progress</span>
<span class="text-white font-bold"><?= $task['progress'] ?>%</span>
</div>
<div class="h-1.5 w-full bg-slate-700 rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-primary to-indigo-400 rounded-full transition-all duration-300" style="width: <?= $task['progress'] ?>%"></div>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
</section>
</div>
</main>

</body>
</html>
