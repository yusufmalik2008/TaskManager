<!DOCTYPE html>
<html class="dark" lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Edit Task - TaskManager Pro</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<script>
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "primary": "#eeaa2b",
                "background-dark": "#0d0d0d",
                "card-dark": "#1a1a1a",
                "border-dark": "#332a19",
            },
            fontFamily: { "display": ["Inter"] },
            borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem"}
        }
    }
}
</script>
<style>
.glow-button {
    box-shadow: 0 0 15px rgba(238, 170, 43, 0.3);
    transition: all 0.3s ease;
}
.glow-button:hover {
    box-shadow: 0 0 25px rgba(238, 170, 43, 0.5);
    transform: translateY(-1px);
}
.pill-active {
    background-color: #eeaa2b !important;
    color: #0d0d0d !important;
}
.border-gradient {
    border: 1px solid transparent;
    background: linear-gradient(#1a1a1a, #1a1a1a) padding-box,
                linear-gradient(to bottom, #483b23, #1a1a1a) border-box;
}
</style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-[#0d0d0d] to-black font-display min-h-screen text-white">
<div class="flex flex-col min-h-screen">
<!-- Top Navigation -->
<header class="flex items-center justify-between border-b border-[#332a19] px-6 lg:px-20 py-6 backdrop-blur-md">
    <div class="flex items-center gap-4">
        <div class="size-12 bg-primary/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-2xl font-bold">task_alt</span>
        </div>
        <div>
            <h2 class="text-2xl font-bold tracking-tight">TaskManager</h2>
            <p class="text-primary/80 text-sm font-medium">Pro Edition</p>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <a href="<?= site_url('tasks') ?>" class="text-gray-400 hover:text-white text-sm font-medium transition-all flex items-center gap-2">
            <span class="material-symbols-outlined">arrow_back</span>
            Back to Tasks
        </a>
        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary/30 to-yellow-500/30 flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-lg">account_circle</span>
        </div>
    </div>
</header>

<main class="flex-1 flex items-center justify-center py-12 px-4 lg:px-8">
    <div class="w-full max-w-2xl">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 mb-8 text-sm text-gray-400">
            <a href="<?= site_url('tasks') ?>" class="hover:text-white transition-colors">Tasks</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-primary font-medium">Edit Task #<?= $task['id'] ?? '' ?></span>
        </nav>

        <!-- Main Form Card -->
        <div class="border-gradient rounded-3xl p-8 lg:p-12 shadow-2xl relative overflow-hidden backdrop-blur-xl bg-[#1a1a1a]/90">
            <!-- Subtle glow effects -->
            <div class="absolute -top-32 -right-32 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-32 -left-32 w-64 h-64 bg-gradient-to-r from-primary/5 to-transparent rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <!-- Header -->
                <div class="mb-12 text-center">
                    <span class="inline-flex px-4 py-2 bg-primary/20 text-primary text-xs font-bold uppercase tracking-wider rounded-full mb-4">
                        Task Management
                    </span>
                    <h1 class="text-4xl lg:text-5xl font-black tracking-tight bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent">
                        Edit Task Details
                    </h1>
                </div>

                <!-- ✅ YOUR PHP FORM - FULLY FUNCTIONAL -->
                <form action="<?= site_url('tasks/update/' . ($task['id'] ?? '')) ?>" method="post" class="space-y-8">
                    <?= csrf_field() ?>
                    
                    <!-- Task Title -->
                    <div class="flex flex-col gap-3">
                        <label class="text-sm font-bold uppercase tracking-wider text-gray-400 ml-1">Task Title <span class="text-red-400">*</span></label>
                        <input 
                            type="text" 
                            name="title" 
                            class="w-full bg-[#0d0d0d]/50 backdrop-blur-sm border-2 border-[#332a19] rounded-2xl p-6 text-2xl font-bold text-white placeholder-gray-500 focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition-all" 
                            placeholder="Enter task title..." 
                            value="<?= esc($task['title'] ?? '') ?>"
                            required
                        >
                    </div>

                    <!-- Description -->
                    <div class="flex flex-col gap-3">
                        <label class="text-sm font-bold uppercase tracking-wider text-gray-400 ml-1">Description</label>
                        <textarea 
                            name="description" 
                            class="w-full bg-[#0d0d0d]/70 backdrop-blur-sm border border-[#332a19] rounded-2xl p-6 text-lg text-gray-200 min-h-[160px] focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-vertical transition-all placeholder-gray-500 leading-relaxed"
                            placeholder="Describe the task in detail..."
                        ><?= esc($task['description'] ?? '') ?></textarea>
                    </div>

                    <!-- Status & Priority -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Status Pills -->
                        <div class="flex flex-col gap-3">
                            <label class="text-sm font-bold uppercase tracking-wider text-gray-400 ml-1">Status</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="pending" class="sr-only peer" <?= ($task['status'] ?? 'pending') == 'pending' ? 'checked' : '' ?> required>
                                    <div class="px-6 py-4 rounded-2xl border-2 border-[#332a19] peer-checked:bg-gradient-to-r peer-checked:from-yellow-500/20 peer-checked:to-yellow-600/20 peer-checked:border-yellow-500 peer-checked:text-yellow-400 font-bold transition-all hover:border-yellow-400">
                                        <span class="material-symbols-outlined text-xl block mb-1">pending_actions</span>
                                        Pending
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="in_progress" class="sr-only peer" <?= ($task['status'] ?? 'pending') == 'in_progress' ? 'checked' : '' ?>>
                                    <div class="px-6 py-4 rounded-2xl border-2 border-[#332a19] peer-checked:bg-gradient-to-r peer-checked:from-blue-500/20 peer-checked:to-blue-600/20 peer-checked:border-blue-500 peer-checked:text-blue-400 font-bold transition-all hover:border-blue-400">
                                        <span class="material-symbols-outlined text-xl block mb-1">autorenew</span>
                                        In Progress
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="completed" class="sr-only peer" <?= ($task['status'] ?? 'pending') == 'completed' ? 'checked' : '' ?>>
                                    <div class="px-6 py-4 rounded-2xl border-2 border-[#332a19] peer-checked:bg-gradient-to-r peer-checked:from-emerald-500/20 peer-checked:to-emerald-600/20 peer-checked:border-emerald-500 peer-checked:text-emerald-400 font-bold transition-all hover:border-emerald-400">
                                        <span class="material-symbols-outlined text-xl block mb-1">check_circle</span>
                                        Completed
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Priority Pills -->
                        <div class="flex flex-col gap-3">
                            <label class="text-sm font-bold uppercase tracking-wider text-gray-400 ml-1">Priority</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="priority" value="low" class="sr-only peer" <?= ($task['priority'] ?? 'medium') == 'low' ? 'checked' : '' ?> required>
                                    <div class="px-6 py-4 rounded-2xl border-2 border-[#332a19] peer-checked:bg-gradient-to-r peer-checked:from-emerald-500/20 peer-checked:to-emerald-600/20 peer-checked:border-emerald-500 peer-checked:text-emerald-400 font-bold transition-all hover:border-emerald-400">
                                        🟢 Low
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="priority" value="medium" class="sr-only peer" <?= ($task['priority'] ?? 'medium') == 'medium' ? 'checked' : '' ?>>
                                    <div class="px-6 py-4 rounded-2xl border-2 border-[#332a19] peer-checked:bg-gradient-to-r peer-checked:from-amber-500/20 peer-checked:to-amber-600/20 peer-checked:border-amber-500 peer-checked:text-amber-400 font-bold transition-all hover:border-amber-400">
                                        🟡 Medium
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="priority" value="high" class="sr-only peer" <?= ($task['priority'] ?? 'medium') == 'high' ? 'checked' : '' ?>>
                                    <div class="px-6 py-4 rounded-2xl border-2 border-[#332a19] peer-checked:bg-gradient-to-r peer-checked:from-red-500/20 peer-checked:to-red-600/20 peer-checked:border-red-500 peer-checked:text-red-400 font-bold transition-all hover:border-red-400">
                                        🔴 High
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-[#332a19] mt-12">
                        <a href="<?= site_url('tasks') ?>" class="flex-1 flex items-center justify-center gap-3 px-8 py-5 rounded-2xl border-2 border-[#332a19] text-gray-400 hover:text-white hover:border-gray-500 backdrop-blur-sm transition-all font-bold uppercase tracking-wider text-sm">
                            <span class="material-symbols-outlined">close</span>
                            Cancel
                        </a>
                        <button type="submit" class="glow-button flex-1 flex items-center justify-center gap-3 bg-primary text-black px-8 py-5 rounded-2xl font-black uppercase tracking-widest text-lg shadow-2xl transition-all">
                            <span class="material-symbols-outlined text-lg">save</span>
                            Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
</div>
</body>
</html>
