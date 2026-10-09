<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Login</title>
    <link rel="icon" href="/6716-removebg-preview.png?v=3">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="min-h-screen lg:flex">
    <div class="brand-panel hidden items-center justify-center p-8 lg:flex">
        <div class="mesh-decor"></div>
        <div class="brand-inner max-w-sm text-white">
            <span class="brand-badge">Result Management System</span>
            <img src="/6716-removebg-preview.png?v=3" alt="" class="mt-6 h-16 w-16 rounded-full bg-white/90 object-contain p-0" onerror="this.style.display='none'">
            <h1 class="mt-4 text-2xl font-bold leading-tight">Shaheed Nur Hossain Memorial School</h1>
            <p class="mt-2 text-sm text-brand-200">Biral, Dinajpur</p>
        </div>
    </div>

    <div class="flex flex-1 items-center justify-center px-4 py-10">
        <div class="w-full max-w-md">
            <div class="mb-6 text-center lg:hidden">
                <img src="/6716-removebg-preview.png?v=3" alt="" class="mx-auto h-12 w-12 rounded-full bg-white/90 object-contain p-0" onerror="this.style.display='none'">
                <h1 class="mt-3 text-lg font-bold text-slate-900">Shaheed Nur Hossain Memorial School</h1>
            </div>

            <div class="card !p-7">
                <h2 class="text-lg font-bold">Sign in</h2>
                <p class="mb-5 text-sm text-slate-500">Use the account given to you by the school admin.</p>

                <div id="error" class="mb-4 hidden rounded-lg bg-red-50 px-3 py-2 text-sm text-red-700" role="alert"></div>

                <form id="login-form" class="space-y-4" autocomplete="on">
                    <div>
                        <label class="label" for="username">Username</label>
                        <input id="username" name="username" type="text" class="input" autocomplete="username" required autofocus>
                    </div>
                    <div>
                        <label class="label" for="password">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" class="input pr-16" autocomplete="current-password" required>
                            <button type="button" id="toggle" class="absolute inset-y-0 right-0 px-3 text-xs font-semibold text-brand-700">Show</button>
                        </div>
                    </div>
                    <button id="submit" type="submit" class="btn-primary w-full !py-2.5">Sign in</button>
                </form>
            </div>
            <p class="mt-5 text-center text-sm"><a href="/" class="back-link text-brand-700">&larr; Back to result portal</a></p>
        </div>
    </div>

    <script src="/js/app.js"></script>
    <script>
        const form = App.$("#login-form"), err = App.$("#error"), btn = App.$("#submit");

        // already signed in? go straight to the dashboard
        App.api("/api/admin/me", { noRedirect: true, quiet: true }).then(function (r) {
            if (r.data.loggedIn) window.location.href = r.data.mustChangePassword ? "/pages/change-password.html" : "/pages/admin.html";
        });

        App.$("#toggle").onclick = function () {
            const p = App.$("#password");
            const show = p.type === "password";
            p.type = show ? "text" : "password";
            this.textContent = show ? "Hide" : "Show";
        };

        form.onsubmit = async function (e) {
            e.preventDefault();
            err.classList.add("hidden");
            btn.disabled = true; btn.textContent = "Signing in...";
            const r = await App.api("/api/admin/login", {
                method: "POST", noRedirect: true,
                json: { username: App.$("#username").value.trim(), password: App.$("#password").value }
            });
            if (r.ok) {
                window.location.href = r.data.must_change_password ? "/pages/change-password.html" : "/pages/admin.html";
                return;
            }
            err.textContent = r.data.message || "Could not sign in.";
            err.classList.remove("hidden");
            btn.disabled = false; btn.textContent = "Sign in";
        };
    </script>
</body>
</html>
