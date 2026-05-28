<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm font-black uppercase tracking-[0.25em] text-orange-500">
                    EventLab Analytics Center
                </p>

                <h2 class="mt-1 text-3xl font-black text-slate-900">
                    Platform Reports
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Visual overview of companies, events, WhatsApp engagement, and booking performance.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('super.dashboard') }}"
                   class="rounded-full bg-slate-100 px-5 py-2.5 text-sm font-bold text-slate-700 transition hover:bg-slate-200">
                    Back to Dashboard
                </a>

                <a href="{{ route('home') }}"
                   target="_blank"
                   class="rounded-full bg-orange-500 px-5 py-2.5 text-sm font-black text-white transition hover:bg-orange-400">
                    View Public Site
                </a>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-100 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <!-- Hero Section -->
            <div class="relative mb-8 overflow-hidden rounded-[2rem] bg-slate-950 p-8 text-white shadow-2xl md:p-10">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-purple-950 to-orange-600"></div>
                <div class="absolute -left-20 top-10 h-80 w-80 rounded-full bg-orange-500/25 blur-3xl"></div>
                <div class="absolute right-10 bottom-0 h-80 w-80 rounded-full bg-green-500/20 blur-3xl"></div>

                <div class="relative z-10 grid gap-8 lg:grid-cols-3 lg:items-center">
                    <div class="lg:col-span-2">
                        <div class="mb-5 inline-flex rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-bold text-orange-200">
                            Super Admin Reports
                        </div>

                        <h1 class="text-4xl font-black leading-tight md:text-5xl">
                            Event<span class="text-orange-400">Lab</span> Platform Insights
                        </h1>

                        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-300">
                            Track platform growth, company approval health, event publishing status,
                            WhatsApp engagement, and booking conversion in a cleaner analytics view.
                        </p>
                    </div>

                    <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-6 backdrop-blur">
                        <p class="text-sm font-black uppercase tracking-[0.2em] text-green-300">
                            Live Summary
                        </p>

                        <div class="mt-5 space-y-4">
                            <div class="flex items-center justify-between rounded-2xl bg-white/10 px-4 py-3">
                                <span class="text-sm text-slate-300">Companies</span>
                                <span class="text-xl font-black">{{ $totalCompanies }}</span>
                            </div>

                            <div class="flex items-center justify-between rounded-2xl bg-white/10 px-4 py-3">
                                <span class="text-sm text-slate-300">Events</span>
                                <span class="text-xl font-black">{{ $totalEvents }}</span>
                            </div>

                            <div class="flex items-center justify-between rounded-2xl bg-white/10 px-4 py-3">
                                <span class="text-sm text-slate-300">WhatsApp Clicks</span>
                                <span class="text-xl font-black">{{ $whatsAppClicks }}</span>
                            </div>

                            <div class="flex items-center justify-between rounded-2xl bg-white/10 px-4 py-3">
                                <span class="text-sm text-slate-300">Bookings</span>
                                <span class="text-xl font-black">{{ $confirmedBookings }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grouped KPI Overview -->
            <div class="grid gap-6 lg:grid-cols-2">
                <!-- Company Health -->
                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-black uppercase tracking-[0.2em] text-orange-500">
                                Company Health
                            </p>

                            <h3 class="mt-2 text-2xl font-black text-slate-900">
                                Company Overview
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Approval and active company status.
                            </p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-orange-100 text-3xl">
                            🏢
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm font-bold text-slate-500">Total</p>
                            <h4 class="mt-3 text-4xl font-black text-slate-900">{{ $totalCompanies }}</h4>
                        </div>

                        <div class="rounded-2xl bg-green-50 p-5">
                            <p class="text-sm font-bold text-green-700">Active</p>
                            <h4 class="mt-3 text-4xl font-black text-green-600">{{ $activeCompanies }}</h4>
                        </div>

                        <div class="rounded-2xl bg-orange-50 p-5">
                            <p class="text-sm font-bold text-orange-700">Pending</p>
                            <h4 class="mt-3 text-4xl font-black text-orange-500">{{ $pendingCompanies }}</h4>
                        </div>
                    </div>

                    <div class="mt-5 rounded-2xl bg-slate-950 p-5 text-white">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-slate-300">Approved company rate</p>

                            <p class="text-xl font-black">
                                {{ $totalCompanies > 0 ? round(($approvedCompanies / $totalCompanies) * 100) : 0 }}%
                            </p>
                        </div>

                        <div class="mt-4 h-3 overflow-hidden rounded-full bg-white/10">
                            <div class="h-full rounded-full bg-green-500"
                                 style="width: {{ $totalCompanies > 0 ? round(($approvedCompanies / $totalCompanies) * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Performance -->
                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-black uppercase tracking-[0.2em] text-purple-500">
                                Event Performance
                            </p>

                            <h3 class="mt-2 text-2xl font-black text-slate-900">
                                Event Publishing
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Public event publishing status.
                            </p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-purple-100 text-3xl">
                            🎟️
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm font-bold text-slate-500">Total</p>
                            <h4 class="mt-3 text-4xl font-black text-slate-900">{{ $totalEvents }}</h4>
                        </div>

                        <div class="rounded-2xl bg-green-50 p-5">
                            <p class="text-sm font-bold text-green-700">Published</p>
                            <h4 class="mt-3 text-4xl font-black text-green-600">{{ $publishedEvents }}</h4>
                        </div>

                        <div class="rounded-2xl bg-orange-50 p-5">
                            <p class="text-sm font-bold text-orange-700">Pending</p>
                            <h4 class="mt-3 text-4xl font-black text-orange-500">{{ $pendingEvents }}</h4>
                        </div>
                    </div>

                    <div class="mt-5 rounded-2xl bg-slate-950 p-5 text-white">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-slate-300">Published event rate</p>

                            <p class="text-xl font-black">
                                {{ $totalEvents > 0 ? round(($publishedEvents / $totalEvents) * 100) : 0 }}%
                            </p>
                        </div>

                        <div class="mt-4 h-3 overflow-hidden rounded-full bg-white/10">
                            <div class="h-full rounded-full bg-purple-500"
                                 style="width: {{ $totalEvents > 0 ? round(($publishedEvents / $totalEvents) * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Engagement -->
                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-black uppercase tracking-[0.2em] text-green-500">
                                Customer Engagement
                            </p>

                            <h3 class="mt-2 text-2xl font-black text-slate-900">
                                WhatsApp Activity
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Customer interest through booking clicks.
                            </p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-green-100 text-3xl">
                            💬
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl bg-purple-50 p-5">
                            <p class="text-sm font-bold text-purple-700">WhatsApp Clicks</p>
                            <h4 class="mt-3 text-4xl font-black text-purple-600">{{ $whatsAppClicks }}</h4>
                            <p class="mt-2 text-sm leading-6 text-purple-700">
                                Customers who clicked the booking CTA.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-green-50 p-5">
                            <p class="text-sm font-bold text-green-700">Enquiries</p>
                            <h4 class="mt-3 text-4xl font-black text-green-600">{{ $whatsAppEnquiries }}</h4>
                            <p class="mt-2 text-sm leading-6 text-green-700">
                                Recorded WhatsApp booking requests.
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 rounded-2xl bg-slate-50 p-5">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-slate-600">
                                Click to enquiry rate
                            </p>

                            <p class="text-2xl font-black text-slate-900">
                                {{ $whatsAppClicks > 0 ? round(($whatsAppEnquiries / $whatsAppClicks) * 100) : 0 }}%
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Booking Conversion -->
                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-black uppercase tracking-[0.2em] text-blue-500">
                                Booking Conversion
                            </p>

                            <h3 class="mt-2 text-2xl font-black text-slate-900">
                                Confirmed Bookings
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Conversion from enquiry to booking.
                            </p>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-3xl">
                            🧾
                        </div>
                    </div>

                    <div class="rounded-2xl bg-orange-50 p-6">
                        <p class="text-sm font-bold text-orange-700">Confirmed Bookings</p>

                        <h4 class="mt-3 text-5xl font-black text-orange-500">
                            {{ $confirmedBookings }}
                        </h4>

                        <p class="mt-3 text-sm leading-6 text-orange-700">
                            Bookings created from enquiries and confirmed through the company/admin workflow.
                        </p>
                    </div>

                    <div class="mt-5 rounded-2xl bg-slate-950 p-5 text-white">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-slate-300">
                                Enquiry to booking rate
                            </p>

                            <p class="text-2xl font-black">
                                {{ $whatsAppEnquiries > 0 ? round(($confirmedBookings / $whatsAppEnquiries) * 100) : 0 }}%
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="mt-10 grid gap-6 lg:grid-cols-2">
                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-black uppercase tracking-[0.2em] text-orange-500">
                                Company Chart
                            </p>

                            <h3 class="mt-2 text-2xl font-black text-slate-900">
                                Company Status Distribution
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Active, approved, and pending company status.
                            </p>
                        </div>
                    </div>

                    <div class="mx-auto max-w-[360px]">
                        <canvas id="companyChart"></canvas>
                    </div>
                </div>

                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-black uppercase tracking-[0.2em] text-purple-500">
                                Event Chart
                            </p>

                            <h3 class="mt-2 text-2xl font-black text-slate-900">
                                Event Publishing Distribution
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Published and pending event approval status.
                            </p>
                        </div>
                    </div>

                    <div class="mx-auto max-w-[360px]">
                        <canvas id="eventChart"></canvas>
                    </div>
                </div>

                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200 lg:col-span-2">
                    <div class="mb-6 flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
                        <div>
                            <p class="text-sm font-black uppercase tracking-[0.2em] text-green-500">
                                Conversion Chart
                            </p>

                            <h3 class="mt-2 text-2xl font-black text-slate-900">
                                Customer Engagement Funnel
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Compare WhatsApp clicks, enquiries, and confirmed bookings.
                            </p>
                        </div>

                        <div class="rounded-full bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600">
                            WhatsApp → Enquiry → Booking
                        </div>
                    </div>

                    <div class="h-[340px]">
                        <canvas id="engagementChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Insights Section -->
            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200 lg:col-span-2">
                    <p class="text-sm font-black uppercase tracking-[0.2em] text-orange-500">
                        Quick Insights
                    </p>

                    <h3 class="mt-2 text-2xl font-black text-slate-900">
                        What the numbers mean
                    </h3>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm font-bold text-slate-500">Company Approval Rate</p>
                            <p class="mt-3 text-3xl font-black text-slate-900">
                                {{ $totalCompanies > 0 ? round(($approvedCompanies / $totalCompanies) * 100) : 0 }}%
                            </p>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Percentage of companies approved by Super Admin.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm font-bold text-slate-500">Event Publish Rate</p>
                            <p class="mt-3 text-3xl font-black text-slate-900">
                                {{ $totalEvents > 0 ? round(($publishedEvents / $totalEvents) * 100) : 0 }}%
                            </p>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Percentage of events currently visible to customers.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm font-bold text-slate-500">Click to Enquiry Rate</p>
                            <p class="mt-3 text-3xl font-black text-slate-900">
                                {{ $whatsAppClicks > 0 ? round(($whatsAppEnquiries / $whatsAppClicks) * 100) : 0 }}%
                            </p>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                How many WhatsApp clicks became recorded enquiries.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <p class="text-sm font-bold text-slate-500">Enquiry to Booking Rate</p>
                            <p class="mt-3 text-3xl font-black text-slate-900">
                                {{ $whatsAppEnquiries > 0 ? round(($confirmedBookings / $whatsAppEnquiries) * 100) : 0 }}%
                            </p>
                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                How many enquiries were converted into confirmed bookings.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] bg-slate-950 p-6 text-white shadow-sm">
                    <p class="text-sm font-black uppercase tracking-[0.2em] text-orange-300">
                        Admin Notes
                    </p>

                    <h3 class="mt-2 text-2xl font-black">
                        Recommended actions
                    </h3>

                    <div class="mt-6 space-y-4">
                        <div class="rounded-2xl bg-white/10 p-4">
                            <p class="text-sm leading-6 text-slate-300">
                                Review pending companies regularly to keep onboarding smooth.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-white/10 p-4">
                            <p class="text-sm leading-6 text-slate-300">
                                Use WhatsApp click data to understand which events attract customer attention.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-white/10 p-4">
                            <p class="text-sm leading-6 text-slate-300">
                                Watch the enquiry-to-booking rate to improve support and booking follow-up.
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('super.events.index') }}"
                           class="block rounded-full bg-orange-500 px-5 py-3 text-center text-sm font-black text-white hover:bg-orange-400">
                            Review Events
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
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

                ctx.font = '900 30px Inter, Figtree, sans-serif';
                ctx.fillStyle = '#0f172a';
                ctx.fillText(pluginOptions.text, centerX, centerY - 8);

                ctx.font = '700 12px Inter, Figtree, sans-serif';
                ctx.fillStyle = '#64748b';
                ctx.fillText(pluginOptions.subtext || '', centerX, centerY + 18);

                ctx.restore();
            }
        };

        Chart.register(centerTextPlugin);

        const companyChartEl = document.getElementById('companyChart');
        const eventChartEl = document.getElementById('eventChart');
        const engagementChartEl = document.getElementById('engagementChart');

        new Chart(companyChartEl, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Approved', 'Pending'],
                datasets: [{
                    data: [
                        @json($activeCompanies),
                        @json($approvedCompanies),
                        @json($pendingCompanies)
                    ],
                    backgroundColor: [
                        '#22c55e',
                        '#3b82f6',
                        '#f97316'
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
                        text: @json($totalCompanies),
                        subtext: 'Companies'
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

        new Chart(eventChartEl, {
            type: 'doughnut',
            data: {
                labels: ['Published', 'Pending'],
                datasets: [{
                    data: [
                        @json($publishedEvents),
                        @json($pendingEvents)
                    ],
                    backgroundColor: [
                        '#16a34a',
                        '#f59e0b'
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
                        text: @json($totalEvents),
                        subtext: 'Events'
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

        const engagementCtx = engagementChartEl.getContext('2d');
        const engagementGradient = engagementCtx.createLinearGradient(0, 0, 0, 340);
        engagementGradient.addColorStop(0, '#9333ea');
        engagementGradient.addColorStop(0.5, '#22c55e');
        engagementGradient.addColorStop(1, '#f97316');

        new Chart(engagementChartEl, {
            type: 'bar',
            data: {
                labels: ['WhatsApp Clicks', 'Enquiries', 'Confirmed Bookings'],
                datasets: [{
                    label: 'Customer Flow',
                    data: [
                        @json($whatsAppClicks),
                        @json($whatsAppEnquiries),
                        @json($confirmedBookings)
                    ],
                    backgroundColor: [
                        '#9333ea',
                        '#22c55e',
                        '#f97316'
                    ],
                    borderRadius: 18,
                    borderSkipped: false,
                    maxBarThickness: 90
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 10,
                        right: 10,
                        bottom: 0,
                        left: 10
                    }
                },
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