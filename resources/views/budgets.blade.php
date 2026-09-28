<x-app-layout>
<div class="cc-card"><h1 class="cc-title">Monthly budgets</h1><p class="cc-muted">Set a spending limit for each student category. Campus Coin compares it with actual transactions.</p>
<form class="cc-form" method="POST" action="{{ route('budgets.store') }}">@csrf
<div><label>Expense category</label><select name="category_id">@foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach</select></div>
<div><label>Limit (PKR)</label><input type="number" name="limit_amount" step=".01" min=".01" required></div><button class="cc-btn green">Save budget</button>
</form></div>
<div class="cc-card"><h2 class="cc-title">Current month budgets</h2><table class="cc-table"><thead><tr><th>Category</th><th>Limit</th><th>Action</th></tr></thead><tbody>
@forelse($budgets as $b)<tr><td>{{ $b->category->name }}</td><td>PKR {{ number_format($b->limit_amount,2) }}</td><td><form method="POST" action="{{ route('budgets.destroy',$b) }}">@csrf @method('DELETE')<button class="cc-btn danger">Remove</button></form></td></tr>@empty<tr><td colspan="3">No budgets configured.</td></tr>@endforelse
</tbody></table></div>
</x-app-layout>