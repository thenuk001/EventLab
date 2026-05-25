<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    private function ensureCompanyOwnsEvent(Event $event): void
    {
        abort_unless($event->company_id === auth()->user()->company_id, 403);
    }

    private function ensureCompanyOwnsTicket(TicketType $ticketType): void
    {
        abort_unless($ticketType->event->company_id === auth()->user()->company_id, 403);
    }

    public function index(Event $event)
    {
        $this->ensureCompanyOwnsEvent($event);

        $event->load(['ticketTypes' => fn ($query) => $query->latest()]);

        return view('company.tickets.index', compact('event'));
    }

    public function create(Event $event)
    {
        $this->ensureCompanyOwnsEvent($event);

        return view('company.tickets.create', compact('event'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        $this->ensureCompanyOwnsEvent($event);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'sold_count' => ['nullable', 'integer', 'min:0'],
            'benefits' => ['nullable', 'string'],
            'availability_status' => ['required', 'in:available,few_left,sold_out,coming_soon'],
        ]);

        $event->ticketTypes()->create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'sold_count' => $validated['sold_count'] ?? 0,
            'benefits' => $validated['benefits'] ?? null,
            'availability_status' => $validated['availability_status'],
        ]);

        return redirect()
            ->route('company.events.tickets.index', $event)
            ->with('success', 'Ticket type created successfully.');
    }

    public function edit(TicketType $ticketType)
    {
        $this->ensureCompanyOwnsTicket($ticketType);

        $ticketType->load('event');

        return view('company.tickets.edit', compact('ticketType'));
    }

    public function update(Request $request, TicketType $ticketType): RedirectResponse
    {
        $this->ensureCompanyOwnsTicket($ticketType);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'sold_count' => ['nullable', 'integer', 'min:0'],
            'benefits' => ['nullable', 'string'],
            'availability_status' => ['required', 'in:available,few_left,sold_out,coming_soon'],
        ]);

        $ticketType->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'sold_count' => $validated['sold_count'] ?? 0,
            'benefits' => $validated['benefits'] ?? null,
            'availability_status' => $validated['availability_status'],
        ]);

        return redirect()
            ->route('company.events.tickets.index', $ticketType->event)
            ->with('success', 'Ticket type updated successfully.');
    }

    public function destroy(TicketType $ticketType): RedirectResponse
    {
        $this->ensureCompanyOwnsTicket($ticketType);

        $event = $ticketType->event;

        $ticketType->delete();

        return redirect()
            ->route('company.events.tickets.index', $event)
            ->with('success', 'Ticket type deleted successfully.');
    }
}