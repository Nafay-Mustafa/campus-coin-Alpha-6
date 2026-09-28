<x-app-layout>
<div class="cc-card" id="report">
<h1 class="cc-title">Spending reports</h1>
<form class="cc-form" method="GET" action="{{ route('reports.index') }}">
<div><label>From</label><input type="date" name="from" value="{{ $from }}"></div><div><label>To</label><input type="date" name="to" value="{{ $to }}" max="{{ now()->toDateString() }}"></div>
<div><label>Category</label><select name="category_id"><option value="">All categories</option>@foreach($categories as $c)<option value="{{ $c->id }}" @selected(request('category_id')==$c->id)>{{ $c->name }}</option>@endforeach</select></div>
<div><label>Type</label><select name="type"><option value="">Income + Expense</option><option value="income" @selected(request('type')==='income')>Income</option><option value="expense" @selected(request('type')==='expense')>Expense</option></select></div>
<button class="cc-btn">Apply filters</button>
<a class="cc-btn light" href="{{ route('reports.csv',['from'=>$from,'to'=>$to]) }}">Export CSV</a>
<button type="button" class="cc-btn light" onclick="window.print()">Print / Save PDF</button>
</form>
</div>
<div class="cc-card"><h2 class="cc-title">Transaction report</h2>
<table class="cc-table"><thead><tr><th>Date</th><th>Type</th><th>Category</th><th>Description</th><th>Amount</th></tr></thead><tbody>
@forelse($tx as $t)<tr><td>{{ $t->date->format('d M Y') }}</td><td><span class="cc-pill {{ $t->type==='income'?'pill-income':'pill-expense' }}">{{ ucfirst($t->type) }}</span></td><td>{{ $t->category->name }}</td><td>{{ $t->description ?: '—' }}</td><td class="{{ $t->type }}">PKR {{ number_format($t->amount,2) }}</td></tr>@empty<tr><td colspan="5">No transactions match these filters.</td></tr>@endforelse
</tbody></table>
</div>
<div class="cc-card"><h2 class="cc-title">CSV import</h2><p class="cc-muted">Use columns: Date, Type, Category, Amount, Description.</p>
<form method="POST" enctype="multipart/form-data" action="{{ route('transactions.import') }}" style="display:flex;gap:8px;flex-wrap:wrap">@csrf<input type="file" name="csv" accept=".csv,.txt" required><button class="cc-btn green">Import transactions</button></form></div>
<style>@media print{.cc-nav,.cc-footer,form{display:none!important}.cc-wrap{max-width:none}.cc-card{box-shadow:none}}</style>
</x-app-layout>