<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Meetings Management') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="mb-4 flex items-center justify-between rounded-md border border-green-400 bg-green-100 p-4 text-green-700">
                            {{ session('success') }}
                            <button type="button" class="ml-2 text-green-700 hover:text-green-900 focus:outline-none"
                                aria-label="Close" @click="show = false">
                                <span aria-hidden="true" class="text-2xl">&times;</span>
                            </button>
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Parent</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Lecturer</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Date</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Time</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Reason</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($meetings as $meeting)
                                <tr>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $meeting->parent->user->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $meeting->lecturer->user->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $meeting->date }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $meeting->time }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 capitalize">{{ $meeting->reason }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 capitalize">{{ $meeting->status }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if ($meeting->status == 'pending')
                                            <form action="{{ route('admin.meetings.approve', $meeting) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-indigo-700">
                                                    {{ __('Approve') }}
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.meetings.reject', $meeting) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="reason"
                                                    placeholder="Enter rejection reason"
                                                    class="w-1rem p-2 mb-2 border rounded">
                                                <button type="submit"
                                                    class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-700">
                                                    {{ __('Reject') }}
                                                </button>
                                            </form>
                                        @elseif ($meeting->status == 'rejected')
                                            <span
                                                class="px-4 py-2 bg-red-400 rounded-xl text-xs font-semibold uppercase">Reason
                                                Updated With Admin Response</span>
                                        @else
                                            <span
                                                class="px-4 py-2 bg-green-400 rounded-xl text-xs font-semibold uppercase">Meeting Scheduled</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
