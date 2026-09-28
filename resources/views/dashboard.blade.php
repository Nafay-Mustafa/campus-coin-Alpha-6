<x-app-layout>
<div class="cc-hero">
  <div class="cc-muted">Good to see you, {{ auth()->user()->name }}</div>
  <h1>Monthly money overview</h1>
  <div class="cc-number">PKR {{ number_format($income-$expense,2) }}</div>
  <div class="cc-muted">Current balance for {{ now()->format('F Y') }}</div>
  <div class="cc-grid cc-grid-4" style="margin-top:18px">
    <div class="cc-stat"><span>Total income</span><strong>PKR {{ number_format($income,0) }}</strong></div>
    <div class="cc-stat"><span>Total expenses</span><strong>PKR {{ number_format($expense,0) }}</strong></div>
    <div class="cc-stat"><span>Saving goal</span><strong>PKR {{ number_format(auth()->user()->saving_goal,0) }}</strong></div>
    <div class="cc-stat"><span>Top category</span><strong>{{ $by->keys()->first() ?? '—' }}</strong></div>
  </div>
</div>

<div class="cc-grid cc-grid-2">
<section class="cc-card">
<h2 class="cc-title">Quick add transaction</h2>
<form class="cc-form" method="POST" action="{{ route('transactions.store') }}">
@csrf
<div><label>Type</label><select name="type" id="type" onchange="filterCategories()" required><option value="expense">Expense</option><option value="income">Income</option></select></div>
<div><label>Category</label><select name="category_id" id="category_id" required>@foreach($categories as $c)<option value="{{ $c->id }}" data-type="{{ $c->type }}">{{ $c->name }} ({{ ucfirst($c->type) }})</option>@endforeach</select></div>
<div><label>Amount (PKR)</label><input type="number" name="amount" min=".01" step=".01" required></div>
<div><label>Date</label><input type="date" name="date" value="{{ now()->toDateString() }}" required></div>
<div class="full"><label>Description</label><input name="description" placeholder="e.g. Campus Cafe lunch"></div>
<div><label><input type="checkbox" name="is_recurring" value="1"> Recurring entry</label></div>
<div><label>Frequency</label><select name="recurring_frequency"><option value="">One time</option><option value="monthly">Monthly</option><option value="weekly">Weekly</option></select></div>
<button class="cc-btn green full">Add transaction</button>
</form>
</section>

<section class="cc-card">
<h2 class="cc-title">Saving tips</h2>
@foreach($tips as $tip)<div class="tip">💡 {{ $tip }}<form method="POST" action="{{ route('bookmarks.store') }}" style="margin-top:7px">@csrf<input type="hidden" name="title" value="Saving tip"><input type="hidden" name="content" value="{{ $tip }}"><button class="cc-btn light" style="padding:5px 8px">Save tip</button></form></div>@endforeach
<div style="margin-top:15px"><a class="cc-btn light" href="{{ route('budgets.index') }}">Set category budgets</a></div>
</section>
</div>

<section class="cc-card">
<h2 class="cc-title">Six-month income vs expense</h2>
<div class="bar-chart">
@php $max=max(1,max(array_merge($monthIncome,$monthExpense))); @endphp
@foreach($months as $i=>$m)
<div style="height:{{ max(5,($monthIncome[$i]/$max)*100) }}%" title="Income: PKR {{ number_format($monthIncome[$i]) }}"><small>{{ $m }}</small></div>
<div style="height:{{ max(5,($monthExpense[$i]/$max)*100) }}%;background:var(--danger)" title="Expense: PKR {{ number_format($monthExpense[$i]) }}"><small>Out</small></div>
@endforeach
</div>
<p class="cc-muted">Green bars represent income; red bars represent expenses.</p>
</section>

<div class="cc-grid cc-grid-2">
<section class="cc-card">
<h2 class="cc-title">Budget vs actual</h2>
@forelse($budgets as $b)
@php $spent=$tx->where('category_id',$b->category_id)->where('type','expense')->sum('amount');$pct=min(100,($spent/max(1,$b->limit_amount))*100); @endphp
<div style="margin-bottom:14px"><div style="display:flex;justify-content:space-between;font-size:.82rem"><b>{{ $b->category->name }}</b><span>PKR {{ number_format($spent,0) }} / {{ number_format($b->limit_amount,0) }}</span></div><div class="progress"><i style="width:{{ $pct }}%"></i></div></div>
@empty <p class="cc-muted">No budgets yet. Create one from the Budgets page.</p>@endforelse
</section>

<section class="cc-card">
<h2 class="cc-title">Recent transactions</h2>
<table class="cc-table"><thead><tr><th>Date</th><th>Details</th><th>Amount</th><th></th></tr></thead><tbody>
@forelse($tx->take(8) as $t)
<tr><td>{{ $t->date->format('d M') }}</td><td><b>{{ $t->description ?: 'Untitled' }}</b><br><span class="cc-muted">{{ $t->category->name }}</span></td><td class="{{ $t->type }}">{{ $t->type==='income'?'+':'-' }} PKR {{ number_format($t->amount,0) }}</td><td><div style="display:flex;gap:4px"><a class="cc-btn light" style="padding:5px 8px" href="{{ route('transactions.edit',$t) }}">Edit</a><form method="POST" action="{{ route('transactions.destroy',$t) }}">@csrf @method('DELETE')<button class="cc-btn light" style="padding:5px 8px">Delete</button></form></div></td></tr>
@empty<tr><td colspan="4" class="cc-muted">No transactions yet.</td></tr>@endforelse
</tbody></table>
</section>
</div>

<section class="cc-card">
<h2 class="cc-title">Manage own categories</h2>
<form method="POST" action="{{ route('categories.store') }}" style="display:flex;gap:8px;flex-wrap:wrap">@csrf<input name="name" placeholder="Category name" required style="flex:1;min-width:180px;padding:10px;border:1px solid var(--line);border-radius:9px;background:var(--bg);color:var(--text)"><select name="type" style="padding:10px;border:1px solid var(--line);border-radius:9px;background:var(--bg);color:var(--text)"><option value="expense">Expense</option><option value="income">Income</option></select><button class="cc-btn">Add category</button></form>
</section>
@push('scripts')
<script>
function filterCategories(){let type=document.getElementById('type').value;document.querySelectorAll('#category_id option').forEach(o=>o.hidden=o.dataset.type!==type);let first=[...document.querySelectorAll('#category_id option')].find(o=>o.dataset.type===type);if(first)document.getElementById('category_id').value=first.value}
filterCategories();
</script>
@endpush
</x-app-layout>