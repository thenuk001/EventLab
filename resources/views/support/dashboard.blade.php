<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-black uppercase tracking-[0.25em] text-orange-500">
                    EventLab Support Center
                </p>

                <h2 class="mt-1 text-2xl font-black text-slate-900">
                    Support Dashboard
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Manage customer enquiries, booking follow-ups, and QR check-ins.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('support.enquiries.index') }}"
                   class="rounded-full bg-slate-100 px-5 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-200">
                    View Enquiries
                </a>

                <a href="{{ route('support.check-in.index') }}"
                   class="rounded-full bg-green-500 px-5 py-2.5 text-sm font-black text-white hover:bg-green-400">
                    QR Check-in
                </a>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-100 py-10">
        <div class="mx-auto max-w-7xl px-4">

            <!-- Hero Section -->
            <div class="relative mb-8 overflow-hidden rounded-[2rem] bg-slate-950 p-8 text-white shadow-2xl md:p-10">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-orange-950 to-green-700"></div>
                <div class="absolute -left-16 top-10 h-72 w-72 rounded-full bg-orange-500/30 blur-3xl"></div>
                <div class="absolute right-10 bottom-0 h-72 w-72 rounded-full bg-green-500/25 blur-3xl"></div>
                <div class="absolute right-40 top-8 h-72 w-72 rounded-full bg-purple-500/20 blur-3xl"></div>

                <div class="relative z-10 grid gap-8 lg:grid-cols-3 lg:items-center">
                    <div class="lg:col-span-2">
                        <div class="mb-5 inline-flex rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-bold text-orange-200">
                            Support Staff Portal
                        </div>

                        <h1 class="text-4xl font-black leading-tight md:text-5xl">
                            Customer Support Operations
                        </h1>

                        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-300">
                            Handle WhatsApp enquiries, contact customers, support booking confirmations,
                            and complete QR ticket check-ins from one fast workspace.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('support.enquiries.index') }}"
                               class="rounded-full bg-white px-7 py-3 text-center text-sm font-black text-slate-950 hover:bg-slate-100">
                                View Enquiries
                            </a>

                            <a href="{{ route('support.check-in.index') }}"
                               class="rounded-full bg-green-500 px-7 py-3 text-center text-sm font-black text-white hover:bg-green-400">
                                Start QR Check-in
                            </a>
                        </div>
                    </div>

                    <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <p class="text-sm font-black uppercase tracking-[0.2em] text-green-300">
                            Today’s Focus
                        </p>

                        <div class="mt-5 flex items-center gap-4">
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-500 text-2xl font-black">
                                SS
                            </div>

                            <div>
                                <h3 class="text-xl font-black">
                                    Support Staff
                                </h3>

                                <p class="mt-1 text-sm text-slate-300">
                                    Customer handling access enabled
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-xs font-bold text-slate-300">New</p>
                                <p class="mt-1 text-2xl font-black">{{ $newEnquiries }}</p>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-xs font-bold text-slate-300">Bookings</p>
                                <p class="mt-1 text-2xl font-black">{{ $confirmedBookings }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            New Enquiries
                        </p>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-2xl">
                            📨
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-orange-500">
                        {{ $newEnquiries }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Customers waiting for response
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            Contacted
                        </p>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-2xl">
                            📞
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-blue-600">
                        {{ $contactedEnquiries }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Enquiries already followed up
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            Confirmed Bookings
                        </p>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100 text-2xl">
                            🧾
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-green-600">
                        {{ $confirmedBookings }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Bookings confirmed in system
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-white p-6 shadow transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-500">
                            QR Check-ins
                        </p>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-2xl">
                            ✅
                        </div>
                    </div>

                    <h3 class="mt-5 text-4xl font-black text-purple-600">
                        {{ $qrCheckIns }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Tickets checked at entrance
                    </p>
                </div>
            </div>

            <!-- Charts + Action Panel -->
            <div class="mt-8 grid gap-6 lg:grid-cols-3">
                <div class="rounded-[2rem] bg-white p-6 shadow lg:col-span-2 md:p-8">
                    <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                        <div>
                            <p class="text-sm font-black uppercase tracking-[0.25em] text-orange-500">
                                Support Analytics
                            </p>

                            <h2 class="mt-2 text-3xl font-black text-slate-950">
                                Enquiry handling overview
                            </h2>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Visual breakdown of support workload and booking progress.
                            </p>
                        </div>

                        <a href="{{ route('support.enquiries.index') }}"
                           class="rounded-full bg-orange-500 px-5 py-3 text-center text-sm font-black text-white hover:bg-orange-400">
                            Manage Enquiries
                        </a>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="rounded-3xl bg-slate-50 p-5">
                            <h3 class="font-black text-slate-900">
                                Enquiry Status
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                New vs contacted enquiries
                            </p>

                            <div class="mx-auto mt-6 max-w-[280px]">
                                <canvas id="enquiryChart"></canvas>
                            </div>
                        </div>

                        <div class="rounded-3xl bg-slate-50 p-5">
                            <h3 class="font-black text-slate-900">
                                Support Activity
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Enquiries, bookings, and QR check-ins
                            </p>

                            <div class="mt-6 h-[280px]">
                                <canvas id="supportBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] bg-slate-950 p-6 text-white shadow md:p-8">
                    <p class="text-sm font-black uppercase tracking-[0.25em] text-green-300">
                        Quick Actions
                    </p>

                    <h3 class="mt-3 text-2xl font-black">
                        What should I do next?
                    </h3>

                    <p class="mt-4 text-sm leading-7 text-slate-300">
                        Start with new enquiries, contact customers, then support booking confirmation
                        and QR check-ins when they arrive at the venue.
                    </p>

                    <div class="mt-6 space-y-3">
                        <a href="{{ route('support.enquiries.index') }}"
                           class="flex items-center justify-between rounded-2xl bg-white/10 px-5 py-4 text-sm font-black hover:bg-orange-500">
                            <span>View customer enquiries</span>
                            <span>→</span>
                        </a>

                        <a href="{{ route('support.check-in.index') }}"
                           class="flex items-center justify-between rounded-2xl bg-white/10 px-5 py-4 text-sm font-black hover:bg-green-500">
                            <span>Open QR check-in</span>
                            <span>→</span>
                        </a>

                        <a href="{{ route('dashboard') }}"
                           class="flex items-center justify-between rounded-2xl bg-white/10 px-5 py-4 text-sm font-black hover:bg-purple-500">
                            <span>Refresh role dashboard</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Workflow Section -->
            <div class="mt-8 rounded-[2rem] bg-white p-6 shadow md:p-8">
                <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="text-sm font-black uppercase tracking-[0.25em] text-orange-500">
                            Support Workflow
                        </p>

                        <h2 class="mt-2 text-3xl font-black text-slate-950">
                            Recommended customer handling flow
                        </h2>
                    </div>

                    <a href="{{ route('support.enquiries.index') }}"
                       class="rounded-full bg-orange-500 px-5 py-3 text-center text-sm font-black text-white hover:bg-orange-400">
                        Start Handling
                    </a>
                </div>

                <div class="grid gap-4 md:grid-cols-4">
                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-orange-500">01</p>

                        <h3 class="mt-2 font-black text-slate-950">
                            Review New
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Check new WhatsApp enquiries from customers.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-blue-500">02</p>

                        <h3 class="mt-2 font-black text-slate-950">
                            Contact Customer
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Follow up with customer and update enquiry status.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-green-500">03</p>

                        <h3 class="mt-2 font-black text-slate-950">
                            Confirm Booking
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Support booking creation and customer confirmation.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-slate-100 p-5">
                        <p class="text-sm font-black text-purple-500">04</p>

                        <h3 class="mt-2 font-black text-slate-950">
                            QR Check-in
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Validate QR ticket codes at the event entrance.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const enquiryChartEl = document.getElementById('enquiryChart');
        const supportBarChartEl = document.getElementById('supportBarChart');

        const chartFont = {
            family: "'Inter', 'Figtree', sans-serif",
            size: 12,
            weight: '700'
        };

        const centerTextPlugin = {
            id: 'centerText',
            beforeDraw(chart, args, pluginOptions) {
                if (!pluginOptions || !pluginOptions.text) return;

                const { ctx, chartArea } = chart;
                const centerX = (chartArea.left + chartArea.right) / 2;
                const centerY = (chartArea.top + chartArea.bottom) / 2;

                ctx.save();
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';

                ctx.font = '900 28px Inter, Figtree, sans-serif';
                ctx.fillStyle = '#0f172a';
                ctx.fillText(pluginOptions.text, centerX, centerY - 8);

                ctx.font = '700 12px Inter, Figtree, sans-serif';
                ctx.fillStyle = '#64748b';
                ctx.fillText(pluginOptions.subtext || '', centerX, centerY + 18);

                ctx.restore();
            }
        };

        Chart.register(centerTextPlugin);

        new Chart(enquiryChartEl, {
            type: 'doughnut',
            data: {
                labels: ['New', 'Contacted'],
                datasets: [{
                    data: [
                        @json($newEnquiries),
                        @json($contactedEnquiries)
                    ],
                    backgroundColor: [
                        '#f97316',
                        '#2563eb'
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 5,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                cutout: '72%',
                plugins: {
                    centerText: {
                        text: @json($newEnquiries + $contactedEnquiries),
                        subtext: 'Enquiries'
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20,
                            font: chartFont
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#ffffff',
                        bodyColor: '#cbd5e1',
                        padding: 14,
                        cornerRadius: 12
                    }
                }
            }
        });

        new Chart(supportBarChartEl, {
            type: 'bar',
            data: {
                labels: ['New', 'Contacted', 'Bookings', 'QR Check-ins'],
                datasets: [{
                    label: 'Support Count',
                    data: [
                        @json($newEnquiries),
                        @json($contactedEnquiries),
                        @json($confirmedBookings),
                        @json($qrCheckIns)
                    ],
                    backgroundColor: [
                        '#f97316',
                        '#2563eb',
                        '#16a34a',
                        '#9333ea'
                    ],
                    borderRadius: 16,
                    borderSkipped: false,
                    maxBarThickness: 70
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#ffffff',
                        bodyColor: '#cbd5e1',
                        padding: 14,
                        cornerRadius: 12
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            color: '#64748b',
                            font: chartFont
                        },
                        grid: {
                            color: '#e2e8f0'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#475569',
                            font: chartFont
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>