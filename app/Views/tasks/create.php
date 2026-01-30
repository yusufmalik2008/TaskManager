<!DOCTYPE html>
<html class="dark" lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Create Task | TaskMaster Pro</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<script>
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "primary": "#137fec",
                "background-dark": "#101922",
                "surface-dark": "#192633",
                "border-dark": "#324d67",
            },
            fontFamily: { "display": ["Inter", "sans-serif"] },
            borderRadius: { "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" }
        }
    }
}
</script>
<style>
.custom-focus:focus {
    border-color: #137fec !important;
    box-shadow: 0 0 0 3px rgba(19, 127, 236, 0.2);
    outline: none;
}
</style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-background-dark to-black font-display min-h-screen text-white">
<div class="relative flex min-h-screen flex-col overflow-hidden">
    <!-- Top Navigation -->
    <header class="flex items-center justify-between px-6 md:px-20 lg:px-32 py-6 border-b border-border-dark/50 backdrop-blur-xl sticky top-0 z-50">
        <div class="flex items-center gap-4">
            <div class="size-12 bg-primary/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                <svg fill="currentColor" viewBox="0 0 48 48" class="w-7 h-7 text-primary">
                    <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-black tracking-tight text-white drop-shadow-lg">TaskMaster</h2>
                <p class="text-primary/90 text-sm font-semibold">Pro Dashboard</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <a href="<?= site_url('tasks') ?>" class="flex items-center gap-2 text-gray-400 hover:text-white px-4 py-2 rounded-xl backdrop-blur-sm transition-all hover:bg-white/10">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                <span class="font-medium">Back to Tasks</span>
            </a>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-r from-primary/40 to-blue-500/40 flex items-center justify-center border-2 border-white/20 shadow-lg">
                <span class="material-symbols-outlined text-white/80 text-lg">account_circle</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center py-12 px-4 md:px-8 lg:px-12">
        <div class="w-full max-w-2xl mx-auto">
            <!-- Form Container -->
            <div class="bg-surface-dark/95 backdrop-blur-2xl rounded-3xl shadow-2xl border border-border-dark/50 overflow-hidden">
                <!-- Header -->
                <div class="p-8 border-b border-border-dark/50 bg-gradient-to-r from-surface-dark to-transparent">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col gap-2">
                            <h1 class="text-4xl font-black bg-gradient-to-r from-white to-gray-100 bg-clip-text text-transparent tracking-tight">
                                Create New Task
                            </h1>
                            <p class="text-gray-400 text-lg font-medium">Add your next task to the workspace</p>
                        </div>
                        <button type="button" onclick="window.location.href='<?= site_url('tasks') ?>'" class="p-3 text-gray-500 hover:text-white rounded-2xl hover:bg-white/10 transition-all">
                            <span class="material-symbols-outlined text-2xl">close</span>
                        </button>
                    </div>
                </div>

                <!-- ✅ YOUR PHP FORM - FULLY FUNCTIONAL -->
                <form action="<?= site_url('tasks') ?>" method="post" class="p-8 lg:p-12 space-y-8">
                    <?= csrf_field() ?>
                    
                    <!-- Task Title -->
                    <div class="flex flex-col gap-3">
                        <label class="text-sm font-bold uppercase tracking-wider text-gray-300">Task Title <span class="text-red-400">*</span></label>
                        <input 
                            name="title"
                            type="text" 
                            class="w-full h-16 px-6 py-4 rounded-2xl bg-background-dark/50 backdrop-blur-sm border-2 border-border-dark/50 text-xl font-semibold text-white placeholder-gray-500 custom-focus transition-all resize-none" 
                            placeholder="e.g. Complete Q1 financial audit report"
                            required
                        >
                    </div>

                    <!-- Description -->
                    <div class="flex flex-col gap-3">
                        <label class="text-sm font-bold uppercase tracking-wider text-gray-300">Description</label>
                        <textarea 
                            name="description"
                            class="w-full min-h-[160px] px-6 py-5 rounded-2xl bg-background-dark/70 backdrop-blur-sm border-2 border-border-dark/50 text-lg text-gray-200 placeholder-gray-500 custom-focus transition-all resize-vertical leading-relaxed" 
                            placeholder="Provide detailed context about this task..."
                        ></textarea>
                        <div class="flex justify-between text-xs text-gray-500">
                            <span>Markdown supported</span>
                            <span>0 / 1000 characters</span>
                        </div>
                    </div>

                    <!-- Status & Priority Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Status Selection -->
                        <div class="flex flex-col gap-4">
                            <label class="text-sm font-bold uppercase tracking-wider text-gray-300">Status</label>
                            <div class="grid grid-cols-3 gap-4">
                                <label class="group cursor-pointer">
                                    <input type="radio" name="status" value="pending" class="sr-only peer" checked required>
                                    <div class="flex flex-col items-center p-5 rounded-2xl border-2 border-border-dark/50 bg-background-dark/30 backdrop-blur-sm group-hover:border-primary/50 transition-all peer-checked:bg-gradient-to-br peer-checked:from-yellow-500/20 peer-checked:to-yellow-400/20 peer-checked:border-yellow-500 peer-checked:text-yellow-300 text-gray-400 h-28">
                                        <span class="material-symbols-outlined text-3xl mb-2">pending_actions</span>
                                        <span class="font-semibold text-sm">Pending</span>
                                    </div>
                                </label>
                                <label class="group cursor-pointer">
                                    <input type="radio" name="status" value="in_progress" class="sr-only peer">
                                    <div class="flex flex-col items-center p-5 rounded-2xl border-2 border-border-dark/50 bg-background-dark/30 backdrop-blur-sm group-hover:border-primary/50 transition-all peer-checked:bg-gradient-to-br peer-checked:from-blue-500/20 peer-checked:to-blue-400/20 peer-checked:border-blue-500 peer-checked:text-blue-300 text-gray-400 h-28">
                                        <span class="material-symbols-outlined text-3xl mb-2">autorenew</span>
                                        <span class="font-semibold text-sm">In Progress</span>
                                    </div>
                                </label>
                                <label class="group cursor-pointer">
                                    <input type="radio" name="status" value="completed" class="sr-only peer">
                                    <div class="flex flex-col items-center p-5 rounded-2xl border-2 border-border-dark/50 bg-background-dark/30 backdrop-blur-sm group-hover:border-primary/50 transition-all peer-checked:bg-gradient-to-br peer-checked:from-emerald-500/20 peer-checked:to-emerald-400/20 peer-checked:border-emerald-500 peer-checked:text-emerald-300 text-gray-400 h-28">
                                        <span class="material-symbols-outlined text-3xl mb-2">check_circle</span>
                                        <span class="font-semibold text-sm">Completed</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Priority Selection -->
                        <div class="flex flex-col gap-4">
                            <label class="text-sm font-bold uppercase tracking-wider text-gray-300">Priority</label>
                            <div class="grid grid-cols-3 gap-4">
                                <label class="group cursor-pointer">
                                    <input type="radio" name="priority" value="low" class="sr-only peer" required>
                                    <div class="flex items-center justify-center gap-3 h-20 rounded-2xl border-2 border-border-dark/50 bg-background-dark/30 backdrop-blur-sm group-hover:border-emerald-400/50 transition-all peer-checked:bg-gradient-to-r peer-checked:from-emerald-500/20 peer-checked:to-emerald-400/20 peer-checked:border-emerald-500 peer-checked:text-emerald-400 font-bold px-6 py-4">
                                        <span class="material-symbols-outlined text-2xl">priority</span>
                                        <span>Low</span>
                                    </div>
                                </label>
                                <label class="group cursor-pointer">
                                    <input type="radio" name="priority" value="medium" class="sr-only peer" checked>
                                    <div class="flex items-center justify-center gap-3 h-20 rounded-2xl border-2 border-border-dark/50 bg-background-dark/30 backdrop-blur-sm group-hover:border-amber-400/50 transition-all peer-checked:bg-gradient-to-r peer-checked:from-amber-500/20 peer-checked:to-amber-400/20 peer-checked:border-amber-500 peer-checked:text-amber-400 font-bold px-6 py-4">
                                        <span class="material-symbols-outlined text-2xl">priority</span>
                                        <span>Medium</span>
                                    </div>
                                </label>
                                <label class="group cursor-pointer">
                                    <input type="radio" name="priority" value="high" class="sr-only peer">
                                    <div class="flex items-center justify-center gap-3 h-20 rounded-2xl border-2 border-border-dark/50 bg-background-dark/30 backdrop-blur-sm group-hover:border-red-400/50 transition-all peer-checked:bg-gradient-to-r peer-checked:from-red-500/20 peer-checked:to-red-400/20 peer-checked:border-red-500 peer-checked:text-red-400 font-bold px-6 py-4">
                                        <span class="material-symbols-outlined text-2xl">priority</span>
                                        <span>High</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-border-dark/50 mt-12">
                        <button type="button" onclick="window.location.href='<?= site_url('tasks') ?>'" class="flex-1 px-8 py-5 rounded-2xl border-2 border-border-dark/50 backdrop-blur-sm text-gray-400 hover:text-white hover:border-gray-400 font-bold uppercase tracking-wider text-sm transition-all hover:bg-white/5">
                            <span class="material-symbols-outlined mr-2">close</span>
                            Cancel
                        </button>
                        <button type="submit" class="glow-button flex-1 bg-gradient-to-r from-primary to-blue-600 hover:from-primary/90 hover:to-blue-600/90 text-white px-8 py-5 rounded-2xl font-black uppercase tracking-widest text-lg shadow-2xl hover:shadow-blue-500/30 transition-all flex items-center justify-center gap-3">
                            <span class="material-symbols-outlined text-lg">add</span>
                            Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>
