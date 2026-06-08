import { useState } from "react";
import { Calendar as CalIcon, User, Mail, Phone, Globe, Users } from "lucide-react";
import { whatsappLink, PHONE, EMAIL } from "@/data/constants";
import { toast } from "@/hooks/use-toast";
import { cn } from "@/lib/utils";
import { format } from "date-fns";
import { Popover, PopoverContent, PopoverTrigger } from "@/components/ui/popover";
import { Calendar as CalendarWidget } from "@/components/ui/calendar";
import { Button } from "@/components/ui/button";

const COUNTRIES = [
  "United States", "United Kingdom", "Canada", "Australia", "Germany",
  "France", "Netherlands", "Italy", "Spain", "Switzerland", "Sweden",
  "Norway", "Denmark", "Belgium", "Ireland", "New Zealand", "South Africa",
  "United Arab Emirates", "India", "Brazil", "Mexico", "Japan", "Singapore",
  "China", "Other",
];

interface Props {
  contextLine?: string;
  subject?: string;
  className?: string;
  ctaLabel?: string;
  heading?: string;
}

/**
 * FORM B — Hotels & Car Hire (has end date, no accommodation preference)
 */
const BookingFormHotel = ({
  contextLine,
  subject = "Reservation Request",
  className,
  ctaLabel = "Make Reservation →",
  heading = "Book Your Stay",
}: Props) => {
  const [start, setStart] = useState<Date>();
  const [end, setEnd] = useState<Date>();
  const [form, setForm] = useState({
    name: "",
    email: "",
    phone: "",
    country: "",
    adults: "2",
    children: "0",
    roomType: "",
    rooms: "1",
    message: "",
  });

  const upd = (k: string, v: string) =>
    setForm((p) => ({ ...p, [k]: v }));

  const onSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!form.name || !form.email || !start || !end) {
      toast({
        title: "Please complete required fields",
        description: "Name, email, check-in and check-out are required.",
      });
      return;
    }
    const msg =
      `${subject}\n` +
      `Name: ${form.name}\n` +
      `Email: ${form.email}\n` +
      `Phone: ${form.phone}\n` +
      `Country: ${form.country}\n` +
      `Check-in: ${format(start, "PPP")}\n` +
      `Check-out: ${format(end, "PPP")}\n` +
      `Adults: ${form.adults} · Children: ${form.children}\n` +
      `Room Type: ${form.roomType}\n` +
      `Number of Rooms: ${form.rooms}\n` +
      `Message: ${form.message}`;

    window.open(whatsappLink(msg), "_blank");
    toast({
      title: "Reservation request sent!",
      description: "We'll confirm availability within 1 hour.",
    });
  };

  const input =
    "w-full border border-border rounded-lg px-3 py-2.5 bg-background text-sm focus:ring-2 focus:ring-primary outline-none";

  return (
    <form
      onSubmit={onSubmit}
      className={cn(
        "bg-card border border-border rounded-2xl p-5 space-y-3 shadow-sm",
        className,
      )}
    >
      <div className="text-center pb-1 border-b border-border">
        <h3 className="text-base font-heading font-bold">{heading}</h3>
        <p className="text-xs text-muted-foreground mt-0.5">
          Direct reservations · Best rates guaranteed
        </p>
        {contextLine && (
          <p className="text-[11px] text-muted-foreground mt-1">{contextLine}</p>
        )}
      </div>

      <div className="relative">
        <User className="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-muted-foreground" />
        <input
          className={`${input} pl-9`}
          placeholder="Your Full Name *"
          value={form.name}
          onChange={(e) => upd("name", e.target.value)}
          required
        />
      </div>

      <div className="relative">
        <Mail className="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-muted-foreground" />
        <input
          type="email"
          className={`${input} pl-9`}
          placeholder="Email Address *"
          value={form.email}
          onChange={(e) => upd("email", e.target.value)}
          required
        />
      </div>

      <div className="relative">
        <Phone className="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-muted-foreground" />
        <input
          type="tel"
          className={`${input} pl-9`}
          placeholder="Phone Number"
          value={form.phone}
          onChange={(e) => upd("phone", e.target.value)}
        />
      </div>

      <div className="relative">
        <Globe className="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-muted-foreground" />
        <select
          className={`${input} pl-9`}
          value={form.country}
          onChange={(e) => upd("country", e.target.value)}
        >
          <option value="">Select Country</option>
          {COUNTRIES.map((c) => (
            <option key={c} value={c}>
              {c}
            </option>
          ))}
        </select>
      </div>

      <div className="grid grid-cols-2 gap-3">
        <div>
          <label className="block text-xs font-heading font-bold mb-1.5 text-foreground">
            <CalIcon className="inline w-3.5 h-3.5 mr-1" />
            Check-in *
          </label>
          <Popover>
            <PopoverTrigger asChild>
              <Button
                type="button"
                variant="outline"
                className={cn(
                  "w-full justify-start text-left font-normal text-xs h-[42px] px-2",
                  !start && "text-muted-foreground",
                )}
              >
                {start ? format(start, "MMM d") : "Pick date"}
              </Button>
            </PopoverTrigger>
            <PopoverContent className="w-auto p-0" align="start">
              <CalendarWidget
                mode="single"
                selected={start}
                onSelect={setStart}
                initialFocus
                className="p-3 pointer-events-auto"
                disabled={(d) => d < new Date()}
              />
            </PopoverContent>
          </Popover>
        </div>
        <div>
          <label className="block text-xs font-heading font-bold mb-1.5 text-foreground">
            <CalIcon className="inline w-3.5 h-3.5 mr-1" />
            Check-out *
          </label>
          <Popover>
            <PopoverTrigger asChild>
              <Button
                type="button"
                variant="outline"
                className={cn(
                  "w-full justify-start text-left font-normal text-xs h-[42px] px-2",
                  !end && "text-muted-foreground",
                )}
              >
                {end ? format(end, "MMM d") : "Pick date"}
              </Button>
            </PopoverTrigger>
            <PopoverContent className="w-auto p-0" align="start">
              <CalendarWidget
                mode="single"
                selected={end}
                onSelect={setEnd}
                initialFocus
                className="p-3 pointer-events-auto"
                disabled={(d) => d < (start || new Date())}
              />
            </PopoverContent>
          </Popover>
        </div>
      </div>

      <div className="grid grid-cols-2 gap-3">
        <div>
          <label className="block text-xs font-heading font-bold mb-1.5 text-foreground">
            <Users className="inline w-3.5 h-3.5 mr-1" />
            Adults
          </label>
          <select
            className={input}
            value={form.adults}
            onChange={(e) => upd("adults", e.target.value)}
          >
            {[1, 2, 3, 4, 5, 6, 7, 8, 9, 10].map((n) => (
              <option key={n} value={n}>
                {n}
              </option>
            ))}
          </select>
        </div>
        <div>
          <label className="block text-xs font-heading font-bold mb-1.5 text-foreground">
            <Users className="inline w-3.5 h-3.5 mr-1" />
            Children (&lt;12)
          </label>
          <select
            className={input}
            value={form.children}
            onChange={(e) => upd("children", e.target.value)}
          >
            {[0, 1, 2, 3, 4, 5].map((n) => (
              <option key={n} value={n}>
                {n}
              </option>
            ))}
          </select>
        </div>
      </div>

      <div className="grid grid-cols-2 gap-3">
        <div>
          <label className="block text-xs font-heading font-bold mb-1.5 text-foreground">
            Room Type
          </label>
          <select
            className={input}
            value={form.roomType}
            onChange={(e) => upd("roomType", e.target.value)}
          >
            <option value="">Select room</option>
            <option>Single Room</option>
            <option>Double Room</option>
            <option>Twin Room</option>
            <option>Triple Room</option>
          </select>
        </div>
        <div>
          <label className="block text-xs font-heading font-bold mb-1.5 text-foreground">
            Number of Rooms
          </label>
          <select
            className={input}
            value={form.rooms}
            onChange={(e) => upd("rooms", e.target.value)}
          >
            {[1, 2, 3, 4, 5, 6].map((n) => (
              <option key={n} value={n}>{n}</option>
            ))}
          </select>
        </div>
      </div>



      <textarea
        rows={3}
        className={input}
        placeholder="Special requests (optional)"
        value={form.message}
        onChange={(e) => upd("message", e.target.value)}
      />

      <button
        type="submit"
        className="w-full bg-accent hover:brightness-110 text-accent-foreground font-heading font-bold rounded-full py-3 text-sm shadow-md transition-all"
      >
        {ctaLabel}
      </button>

      <p className="text-[11px] text-muted-foreground text-center pt-1">
        📞 {PHONE} · {EMAIL}
      </p>
    </form>
  );
};

export default BookingFormHotel;
