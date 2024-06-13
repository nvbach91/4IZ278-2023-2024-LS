<div>
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
        <h1 class="text-2xl font-bold mb-4">Send a transaction from {{ $account->display_name }}</h1>
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-6">
            <h2 class="text-lg font-semibold">Account balance:</h2>
            <div class="flex justify-between items-center bg-gray-100 p-4 rounded-lg shadow mt-2">
                <span wire:model="displayBalance" class="text-3xl font-bold">{{ number_format($displayBalance, 2) }}-,</span>
            </div>
        </div>
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Send a transaction:</h2>
            <form method="POST" action="{{ route('account.make-payment',['account' => $account->id]) }}" class="space-y-4">
                @csrf
                <div>
                    <label for="targetAccount" class="block text-sm font-medium text-gray-700">Target account</label>
                    <select name="targetAccount" id="targetAccount" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select target account</option>
                        @foreach($allAccounts as $targetAccount)
                            <option value="{{ $targetAccount->id }}">{{ $targetAccount->display_name }} - {{$targetAccount->getOwner()->name}}</option>
                        @endforeach
                    </select>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input wire:model.live.debounce.50ms="transactionAmount" wire:keydown.debounce.50ms="amountChanged" type="number" id="amount" name="amount" min="0" step="0.01" max="{{$account->balance}}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <textarea name="message" id="message" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Message"></textarea>
                </div>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Send transaction
                </button>
            </form>
        </div>
    </div>
</div>
