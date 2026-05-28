<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-black uppercase tracking-[0.25em] text-green-600">
                    EventLab Support Center
                </p>

                <h2 class="mt-1 text-2xl font-black text-slate-900">
                    QR / Manual Check-in
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Scan ticket QR codes or validate tickets manually.
                </p>
            </div>

            <a href="{{ route('support.dashboard') }}"
               class="rounded-full bg-slate-100 px-5 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-200">
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-100 py-10">
        <div class="mx-auto max-w-7xl px-4">

            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-green-100 p-4 font-bold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-2xl bg-red-100 p-4 font-bold text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-2xl bg-red-100 p-4 font-bold text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Hero Section -->
            <div class="relative mb-8 overflow-hidden rounded-[2rem] bg-slate-950 p-8 text-white shadow-2xl md:p-10">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-orange-950 to-green-700"></div>
                <div class="absolute -left-16 top-10 h-72 w-72 rounded-full bg-orange-500/30 blur-3xl"></div>
                <div class="absolute right-10 bottom-0 h-72 w-72 rounded-full bg-green-500/25 blur-3xl"></div>
                <div class="absolute right-40 top-8 h-72 w-72 rounded-full bg-purple-500/20 blur-3xl"></div>

                <div class="relative z-10 grid gap-8 lg:grid-cols-3 lg:items-center">
                    <div class="lg:col-span-2">
                        <div class="mb-5 inline-flex rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-bold text-green-200">
                            Camera + Manual Validation
                        </div>

                        <h1 class="text-4xl font-black leading-tight md:text-5xl">
                            Ticket Check-in Scanner
                        </h1>

                        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-300">
                            Use the camera scanner to scan real QR tickets, or manually enter a ticket code.
                            The system will validate the ticket and prevent duplicate check-ins.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            <button id="startScannerBtn"
                                    type="button"
                                    class="rounded-full bg-green-500 px-7 py-3 text-center text-sm font-black text-white hover:bg-green-400">
                                Open Camera Scanner
                            </button>

                            <button id="stopScannerBtn"
                                    type="button"
                                    class="hidden rounded-full bg-red-500 px-7 py-3 text-center text-sm font-black text-white hover:bg-red-400">
                                Stop Scanner
                            </button>

                            <a href="{{ route('support.enquiries.index') }}"
                               class="rounded-full bg-white px-7 py-3 text-center text-sm font-black text-slate-950 hover:bg-slate-100">
                                View Enquiries
                            </a>
                        </div>
                    </div>

                    <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <p class="text-sm font-black uppercase tracking-[0.2em] text-orange-300">
                            How it works
                        </p>

                        <div class="mt-5 space-y-3">
                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-sm font-black text-white">01. Open camera</p>
                                <p class="mt-1 text-sm text-slate-300">Allow browser camera permission.</p>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-sm font-black text-white">02. Scan QR</p>
                                <p class="mt-1 text-sm text-slate-300">Point camera at customer ticket QR.</p>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-sm font-black text-white">03. Validate</p>
                                <p class="mt-1 text-sm text-slate-300">Ticket becomes checked in instantly.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Grid -->
            <div class="grid gap-8 lg:grid-cols-3">
                <!-- Camera Scanner -->
                <div class="lg:col-span-2">
                    <div class="rounded-[2rem] bg-white p-6 shadow md:p-8">
                        <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                            <div>
                                <p class="text-sm font-black uppercase tracking-[0.25em] text-green-500">
                                    Camera Scanner
                                </p>

                                <h2 class="mt-2 text-3xl font-black text-slate-950">
                                    Scan Ticket QR Code
                                </h2>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Click open camera, scan the ticket QR code, and validate the ticket automatically.
                                </p>
                            </div>

                            <span id="scannerStatus"
                                  class="rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-600">
                                Scanner closed
                            </span>
                        </div>

                        <div id="scannerWrapper" class="hidden">
                            <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-4">
                                <div id="qr-reader" class="overflow-hidden rounded-2xl bg-white"></div>
                            </div>
                        </div>

                        <div id="scannerEmptyState"
                             class="rounded-[1.5rem] border border-dashed border-slate-300 bg-slate-50 p-10 text-center">
                            <div class="text-6xl">📷</div>

                            <h3 class="mt-4 text-2xl font-black text-slate-900">
                                Camera scanner is ready
                            </h3>

                            <p class="mx-auto mt-2 max-w-xl text-sm leading-6 text-slate-500">
                                Click the “Open Camera Scanner” button above. Camera access works best on localhost
                                during development or HTTPS when hosted online.
                            </p>
                        </div>

                        <div id="scanResult" class="mt-6 hidden rounded-[1.5rem] p-5"></div>
                    </div>
                </div>

                <!-- Manual Search -->
                <div>
                    <div class="rounded-[2rem] bg-white p-6 shadow md:p-8">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-black uppercase tracking-[0.25em] text-orange-500">
                                    Manual Check
                                </p>

                                <h2 class="mt-2 text-2xl font-black text-slate-950">
                                    Search Ticket
                                </h2>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Use this if the camera cannot read the QR code.
                                </p>
                            </div>

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-3xl">
                                🔎
                            </div>
                        </div>

                        <form method="POST"
                              action="{{ route('support.check-in.search') }}"
                              class="mt-6">
                            @csrf

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                QR Ticket Code
                            </label>

                            <input type="text"
                                   name="ticket_code"
                                   value="{{ old('ticket_code') }}"
                                   placeholder="Example: QR-ABC123XYZ"
                                   class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-lg font-black uppercase text-slate-950 shadow-sm focus:border-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-200"
                                   required>

                            @error('ticket_code')
                                <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                            @enderror

                            <button class="mt-6 w-full rounded-full bg-orange-500 px-6 py-4 text-lg font-black text-white hover:bg-orange-400">
                                Search Ticket
                            </button>
                        </form>
                    </div>

                    <div class="mt-6 rounded-[2rem] bg-slate-950 p-6 text-white shadow md:p-8">
                        <p class="text-sm font-black uppercase tracking-[0.25em] text-green-300">
                            Validation Rules
                        </p>

                        <div class="mt-5 space-y-3">
                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-sm font-black text-green-300">Valid Ticket</p>
                                <p class="mt-1 text-sm text-slate-300">
                                    Ticket will be marked as checked in.
                                </p>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-sm font-black text-orange-300">Already Used</p>
                                <p class="mt-1 text-sm text-slate-300">
                                    System blocks duplicate check-ins.
                                </p>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-sm font-black text-red-300">Invalid / Cancelled</p>
                                <p class="mt-1 text-sm text-slate-300">
                                    Ticket cannot be checked in.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Workflow -->
            <div class="mt-8 rounded-[2rem] bg-white p-6 shadow md:p-8">
                <div class="mb-6">
                    <p class="text-sm font-black uppercase tracking-[0.25em] text-green-500">
                        Check-in Workflow
                    </p>

                    <h2 class="mt-2 text-3xl font-black text-slate-950">
                        Fast entrance validation process
                    </h2>
                </div>

                <div class="grid gap-4 md:grid-cols-4">
                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-green-500">01</p>
                        <h3 class="mt-2 font-black text-slate-950">Ask for Ticket</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Customer shows QR ticket from phone or print.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-orange-500">02</p>
                        <h3 class="mt-2 font-black text-slate-950">Scan QR</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Open camera scanner and scan the QR code.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-blue-500">03</p>
                        <h3 class="mt-2 font-black text-slate-950">Validate</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            System confirms validity and blocks duplicates.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-purple-500">04</p>
                        <h3 class="mt-2 font-black text-slate-950">Allow Entry</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Let customer enter when success message appears.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        const startScannerBtn = document.getElementById('startScannerBtn');
        const stopScannerBtn = document.getElementById('stopScannerBtn');
        const scannerWrapper = document.getElementById('scannerWrapper');
        const scannerEmptyState = document.getElementById('scannerEmptyState');
        const scannerStatus = document.getElementById('scannerStatus');
        const scanResult = document.getElementById('scanResult');

        const scanRoute = @json(route('support.check-in.scan'));
        const csrfToken = @json(csrf_token());

        let html5QrCode = null;
        let scannerRunning = false;
        let scanLocked = false;
        let lastScannedCode = null;

        function setScannerStatus(text, type = 'closed') {
            scannerStatus.textContent = text;
            scannerStatus.className = 'rounded-full px-4 py-2 text-sm font-black';

            if (type === 'open') {
                scannerStatus.classList.add('bg-green-100', 'text-green-700');
            } else if (type === 'scanning') {
                scannerStatus.classList.add('bg-blue-100', 'text-blue-700');
            } else if (type === 'error') {
                scannerStatus.classList.add('bg-red-100', 'text-red-700');
            } else {
                scannerStatus.classList.add('bg-slate-100', 'text-slate-600');
            }
        }

        function showResult(type, message, ticket = null) {
            scanResult.classList.remove(
                'hidden',
                'bg-green-50',
                'bg-red-50',
                'bg-orange-50',
                'text-green-800',
                'text-red-800',
                'text-orange-800',
                'border',
                'border-green-200',
                'border-red-200',
                'border-orange-200'
            );

            if (type === 'success') {
                scanResult.classList.add('bg-green-50', 'text-green-800', 'border', 'border-green-200');
            } else if (type === 'warning') {
                scanResult.classList.add('bg-orange-50', 'text-orange-800', 'border', 'border-orange-200');
            } else {
                scanResult.classList.add('bg-red-50', 'text-red-800', 'border', 'border-red-200');
            }

            let icon = type === 'success' ? '✅' : (type === 'warning' ? '⚠️' : '❌');

            let html = `
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-2xl shadow-sm">
                        ${icon}
                    </div>

                    <div class="flex-1">
                        <p class="text-xl font-black">${message}</p>
            `;

            if (ticket) {
                html += `
                    <div class="mt-4 grid gap-3 text-sm md:grid-cols-2">
                        <div class="rounded-2xl bg-white/70 p-3">
                            <strong>Ticket Code:</strong><br>${ticket.code ?? '-'}
                        </div>

                        <div class="rounded-2xl bg-white/70 p-3">
                            <strong>Holder:</strong><br>${ticket.holder ?? '-'}
                        </div>

                        <div class="rounded-2xl bg-white/70 p-3">
                            <strong>Event:</strong><br>${ticket.event ?? '-'}
                        </div>

                        <div class="rounded-2xl bg-white/70 p-3">
                            <strong>Ticket Type:</strong><br>${ticket.ticket_type ?? '-'}
                        </div>

                        <div class="rounded-2xl bg-white/70 p-3">
                            <strong>Booking:</strong><br>${ticket.booking_code ?? '-'}
                        </div>

                        <div class="rounded-2xl bg-white/70 p-3">
                            <strong>Checked In:</strong><br>${ticket.checked_in_at ?? '-'}
                        </div>
                    </div>
                `;
            }

            html += `
                    </div>
                </div>
            `;

            scanResult.innerHTML = html;
        }

        async function validateTicket(ticketCode) {
            try {
                const response = await fetch(scanRoute, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        ticket_code: ticketCode
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    showResult('success', data.message || 'Ticket validated successfully.', data.ticket || null);
                } else if (response.status === 409) {
                    showResult('warning', data.message || 'This ticket has already been checked in.', data.ticket || null);
                } else {
                    showResult('error', data.message || 'Invalid ticket.');
                }
            } catch (error) {
                showResult('error', 'Something went wrong while validating the ticket.');
            } finally {
                setTimeout(() => {
                    scanLocked = false;
                    lastScannedCode = null;
                }, 2500);
            }
        }

        async function startScanner() {
            if (scannerRunning) {
                return;
            }

            scannerWrapper.classList.remove('hidden');
            scannerEmptyState.classList.add('hidden');

            startScannerBtn.classList.add('hidden');
            stopScannerBtn.classList.remove('hidden');

            setScannerStatus('Starting camera...', 'scanning');

            try {
                html5QrCode = new Html5Qrcode('qr-reader');

                const config = {
                    fps: 10,
                    qrbox: {
                        width: 260,
                        height: 260
                    },
                    aspectRatio: 1.0
                };

                await html5QrCode.start(
                    { facingMode: 'environment' },
                    config,
                    function(decodedText) {
                        const code = decodedText.trim().toUpperCase();

                        if (scanLocked || code === lastScannedCode) {
                            return;
                        }

                        scanLocked = true;
                        lastScannedCode = code;

                        setScannerStatus('Ticket scanned', 'open');
                        validateTicket(code);
                    },
                    function() {
                        // Ignore continuous scan errors
                    }
                );

                scannerRunning = true;
                setScannerStatus('Scanner running', 'open');
            } catch (error) {
                scannerWrapper.classList.add('hidden');
                scannerEmptyState.classList.remove('hidden');

                startScannerBtn.classList.remove('hidden');
                stopScannerBtn.classList.add('hidden');

                setScannerStatus('Camera error', 'error');
                showResult('error', 'Camera could not be opened. Please allow camera permission or use manual ticket search.');
            }
        }

        async function stopScanner() {
            if (!html5QrCode || !scannerRunning) {
                return;
            }

            try {
                await html5QrCode.stop();
                await html5QrCode.clear();
            } catch (error) {
                // Ignore stop errors
            }

            html5QrCode = null;
            scannerRunning = false;
            scanLocked = false;
            lastScannedCode = null;

            scannerWrapper.classList.add('hidden');
            scannerEmptyState.classList.remove('hidden');

            startScannerBtn.classList.remove('hidden');
            stopScannerBtn.classList.add('hidden');

            setScannerStatus('Scanner closed', 'closed');
        }

        startScannerBtn.addEventListener('click', startScanner);
        stopScannerBtn.addEventListener('click', stopScanner);
    </script>
</x-app-layout>