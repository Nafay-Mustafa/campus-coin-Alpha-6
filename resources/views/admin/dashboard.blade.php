<x-app-layout>
<div class="cc-hero"><div class="cc-muted">Administrator Control Panel</div><h1>Campus Coin overview</h1><div class="cc-grid cc-grid-4" style="margin-top:18px">@foreach($stats as $key=>$value)<div class="cc-stat"><span>{{ ucwords(str_replace('_',' ',$key)) }}</span><strong>{{ number_format($value) }}</strong></div>@endforeach</div></div>
<div class="cc-grid cc-grid-2">
<section class="cc-card"><h2 class="cc-title">Default category management</h2>
<form class="cc-form" method="POST" action="{{ route('admin.categories.store') }}">@csrf<div><label>Name</label><input name="name" required></div><div><label>Type</label><select name="type"><option value="expense">Expense</option><option value="income">Income</option></select></div><button class="cc-btn green">Add default</button></form>
<table class="cc-table" style="margin-top:14px"><thead><tr><th>Category</th><th>Type</th><th></th></tr></thead><tbody>@foreach($categories as $c)<tr><td>{{ $c->name }}</td><td>{{ ucfirst($c->type) }}</td><td><form method="POST" action="{{ route('admin.categories.destroy',$c) }}">@csrf @method('DELETE')<button class="cc-btn danger" style="padding:5px 8px">Delete</button></form></td></tr>@endforeach</tbody></table>
</section>
<section class="cc-card"><h2 class="cc-title">Recent users</h2><table class="cc-table"><thead><tr><th>Name</th><th>Email</th><th>Joined</th></tr></thead><tbody>@foreach($users as $u)<tr><td>{{ $u->name }} @if($u->is_admin)<span class="cc-pill pill-income">Admin</span>@endif</td><td>{{ $u->email }}</td><td>{{ $u->created_at->format('d M Y') }}</td></tr>@endforeach</tbody></table></section>
</div>
</x-app-layout>