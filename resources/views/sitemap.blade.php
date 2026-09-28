<x-app-layout>
<div class="cc-card"><h1 class="cc-title">Campus Coin Sitemap</h1><p class="cc-muted">This page is included in the application as required by the project brief.</p>
<div class="cc-grid cc-grid-3">
<div class="tip"><b>Public</b><br><a href="{{ route('home') }}">Home</a><br><a href="{{ route('login') }}">Student Login</a><br><a href="{{ route('register') }}">Registration</a><br><a href="{{ route('admin.login') }}">Administrator Login</a></div>
<div class="tip"><b>Student Area</b><br><a href="{{ route('dashboard') }}">Dashboard</a><br><a href="{{ route('budgets.index') }}">Budgets</a><br><a href="{{ route('reports.index') }}">Reports & Import</a><br>Profile / Password / 2FA</div>
<div class="tip"><b>Administration</b><br><a href="{{ route('admin.dashboard') }}">Admin Control Panel</a><br>Default Categories<br>User & Usage Statistics</div>
</div></div></x-app-layout>