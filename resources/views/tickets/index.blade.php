<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-6">List of Tickets</h1>

    <a href="{{ route('tickets.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create Ticket</a>

    <table class="min-w-full bg-white rounded-lg shadow">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">User ID</th>
                <th class="py-2 px-4 border-b">Checkup</th>
                <th class="py-2 px-4 border-b">Makan</th>
                <th class="py-2 px-4 border-b">Used</th>
                <th class="py-2 px-4 border-b">QR Code</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $ticket->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $ticket->id_user }}</td>
                    <td class="py-2 px-4 border-b">{{ $ticket->checkup ? 'Yes' : 'No' }}</td>
                    <td class="py-2 px-4 border-b">{{ $ticket->makan ? 'Yes' : 'No' }}</td>
                    <td class="py-2 px-4 border-b">{{ $ticket->used ? 'Yes' : 'No' }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $ticket->qr_code }}" target="_blank">
                            View QR
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-4 text-center">No tickets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
