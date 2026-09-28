<!doctype html>
<html lang="en" data-theme="light">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>{{ $title ?? 'Campus Coin' }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
<style>
:root{--navy:#0f3d5c;--deep:#0a2c42;--green:#2fa974;--bg:#f6faf8;--card:#fff;--text:#12262a;--muted:#647b77;--line:#dce8e3;--danger:#c0553a}
[data-theme=dark]{--bg:#0b1f27;--card:#102a33;--text:#eaf3f0;--muted:#9bb2ad;--line:#23424a}
*{box-sizing:border-box}body{margin:0;background:var(--bg);color:var(--text);font-family:Inter,system-ui,sans-serif}a{text-decoration:none;color:inherit}
.cc-wrap{max-width:1180px;margin:auto;padding:18px}.cc-nav{position:sticky;top:12px;z-index:20;background:linear-gradient(135deg,var(--deep),var(--navy));color:#fff;border-radius:16px;padding:12px 16px;box-shadow:0 10px 30px #0a2c4220}.cc-nav-inner{display:flex;align-items:center;gap:14px}.cc-brand{font:800 1.15rem Sora}.cc-brand small{display:block;font:500 .62rem Inter;color:#b9d8cc;margin-top:2px}.cc-links{display:flex;gap:5px;flex:1}.cc-links a,.cc-actions button{border:0;background:transparent;color:#dceee8;padding:8px 10px;border-radius:9px;font-weight:600;font-size:.82rem;cursor:pointer}.cc-links a:hover,.cc-links a.active{background:#ffffff18;color:#fff}.cc-actions{display:flex;gap:4px;align-items:center}.cc-user{font-size:.8rem;color:#dceee8}.cc-main{padding-top:22px}.cc-card{background:var(--card);border:1px solid var(--line);border-radius:15px;padding:20px;margin-bottom:18px;box-shadow:0 5px 18px #0a2c4208}.cc-grid{display:grid;gap:16px}.cc-grid-4{grid-template-columns:repeat(4,1fr)}.cc-grid-2{grid-template-columns:repeat(2,1fr)}.cc-grid-3{grid-template-columns:repeat(3,1fr)}.cc-hero{background:linear-gradient(135deg,var(--deep),var(--navy));color:#fff;border-radius:18px;padding:25px;margin-bottom:18px}.cc-hero h1{margin:0 0 6px;font:800 1.55rem Sora}.cc-muted{color:var(--muted);font-size:.83rem}.cc-hero .cc-muted{color:#b9d8cc}.cc-number{font:800 2.15rem Sora}.cc-stat{background:#ffffff12;border-radius:12px;padding:13px}.cc-stat span{display:block;font-size:.72rem;color:#b9d8cc}.cc-stat strong{font-size:1.15rem}.cc-title{font:700 1.05rem Sora;margin:0 0 14px}.cc-form{display:grid;grid-template-columns:repeat(2,1fr);gap:11px}.cc-form .full{grid-column:1/-1}.cc-form label{font-size:.75rem;color:var(--muted);display:block;margin-bottom:5px}.cc-form input,.cc-form select,.cc-form textarea{width:100%;border:1px solid var(--line);border-radius:9px;padding:10px;background:var(--bg);color:var(--text);font:inherit}.cc-btn{display:inline-block;border:0;border-radius:9px;padding:10px 14px;background:var(--navy);color:#fff;font-weight:700;cursor:pointer}.cc-btn.green{background:var(--green)}.cc-btn.danger{background:var(--danger)}.cc-btn.light{background:var(--bg);color:var(--text);border:1px solid var(--line)}.cc-table{width:100%;border-collapse:collapse;font-size:.82rem}.cc-table th,.cc-table td{text-align:left;padding:10px;border-bottom:1px solid var(--line)}.cc-table th{color:var(--muted);font-size:.72rem}.cc-pill{display:inline-block;border-radius:999px;padding:4px 8px;font-size:.7rem;font-weight:700}.income{color:#1f7a54}.expense{color:#c0553a}.pill-income{background:#dff6eb;color:#1f7a54}.pill-expense{background:#fae3dc;color:#a9432d}.cc-alert{padding:11px 14px;border-radius:10px;background:#e4f6ed;color:#1f7a54;margin-bottom:16px;font-size:.84rem}.cc-error{padding:11px 14px;border-radius:10px;background:#fae3dc;color:#a9432d;margin-bottom:16px}.breadcrumb{font-size:.72rem;color:var(--muted);margin:0 0 12px}.breadcrumb a{text-decoration:underline}.cc-footer{text-align:center;color:var(--muted);font-size:.75rem;padding:30px 0}.progress{height:9px;background:var(--line);border-radius:8px;overflow:hidden}.progress i{display:block;height:100%;background:var(--green)}.tip{padding:12px;border:1px solid var(--line);border-radius:10px;margin-bottom:9px;font-size:.82rem;line-height:1.5}.cc-chart{height:230px}.bar-chart{height:190px;display:flex;align-items:end;gap:10px}.bar-chart div{flex:1;background:var(--green);border-radius:5px 5px 0 0;min-height:4px}.bar-chart small{display:block;text-align:center;margin-top:5px;color:var(--muted);font-size:.65rem}.mobile-menu{display:none}@media(max-width:850px){.cc-grid-4,.cc-grid-3{grid-template-columns:repeat(2,1fr)}.cc-links{overflow:auto}.cc-user{display:none}}@media(max-width:600px){.cc-wrap{padding:10px}.cc-grid-4,.cc-grid-3,.cc-grid-2,.cc-form{grid-template-columns:1fr}.cc-form .full{grid-column:auto}.cc-nav{position:static}.cc-links a{white-space:nowrap}.cc-hero .cc-number{font-size:1.8rem}}

.cc-brand{display:flex;align-items:center;gap:9px}
.cc-logo-link{display:inline-flex;align-items:center}
.cc-logo-img{width:48px;height:48px;object-fit:contain;display:block}
.cc-brand span{display:block;font:800 1.15rem Sora}
</style>
@stack('head')
</head>
<body>
<div class="cc-wrap">
<nav class="cc-nav"><div class="cc-nav-inner">
<a class="cc-brand" href="{{ route('dashboard') }}">
<img src="{{ asset('images/campus-coin-logo.png') }}" alt="Campus Coin" class="cc-logo-img">
<span>Campus Coin<small>NextGen BudgetBee</small></span>
</a>
<div class="cc-links">
<a class="{{ request()->routeIs('dashboard')?'active':'' }}" href="{{ route('dashboard') }}">Dashboard</a>
<a class="{{ request()->routeIs('budgets.*')?'active':'' }}" href="{{ route('budgets.index') }}">Budgets</a>
<a class="{{ request()->routeIs('reports.*')?'active':'' }}" href="{{ route('reports.index') }}">Reports</a>
<a href="{{ route('sitemap') }}">Sitemap</a>
@if(auth()->user()?->is_admin)<a href="{{ route('admin.dashboard') }}">Admin</a>@endif
</div>
<div class="cc-actions"><button onclick="toggleTheme()">◐</button><a class="cc-user" href="{{ route('profile.settings') }}">{{ auth()->user()->name }}</a>
<form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Logout</button></form></div>
</div></nav>
<main class="cc-main"><div class="breadcrumb"><a href="{{ route('dashboard') }}">Campus Coin</a> / {{ ucwords(str_replace(['.','-'],' ',request()->route()->getName() ?? 'page')) }}</div>
@if(session('success'))<div class="cc-alert">{{ session('success') }}</div>@endif
@if($errors->any())<div class="cc-error"><ul style="margin:0;padding-left:18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
{{ $slot ?? '' }}
@yield('content')
</main>
<footer class="cc-footer">Campus Coin · Student-first budgeting · Built with Laravel</footer>
</div>
<script>
function toggleTheme(){let h=document.documentElement;let d=h.getAttribute('data-theme')==='dark';h.setAttribute('data-theme',d?'light':'dark');localStorage.setItem('cc-theme',d?'light':'dark')}
(()=>{let t=localStorage.getItem('cc-theme');if(t)document.documentElement.setAttribute('data-theme',t)})();
document.querySelectorAll('form').forEach(f=>f.addEventListener('submit',()=>{let b=f.querySelector('button[type=submit],button:not([type])');if(b){b.disabled=true;b.dataset.old=b.textContent;b.textContent='Please wait…'}}));
</script>
@stack('scripts')
</body></html>