import { useState } from "react";
import { Calendar as CalIcon, User, Mail, Phone, Globe, Users, Bed } from "lucide-react";
import { whatsappLink, PHONE, RESERVATIONS_EMAIL } from "@/data/constants";
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
  /** Optional context line shown below the heading (e.g. tour name + duration). */
  contextLine?: string;
  /** Prefix used in the WhatsApp message and toast (e.g. tour name). */
  subject?: string;
  className?: string;
  compact?: boolean;
}

/**
 * FORM A — Tours (no end date, includes accommodation preference)
 * Used on safari detail, destination detail, and tour landing pages.
 */
const BookingFormTour = ({
  contextLine,
  subject = "Safari Enquiry",
  className,
  compact = false,
}: Props) => {
  const [startDate, setStartDate] = useState<Date>();
  const [form, setForm] = useState({
    name: "",
    email: "",
    phone: "",
    country: "",
    accommodation: "either",
    adults: "2",
    children: "0",
    message: "",
  });


  const upd = (k: string, v: string) =>
    setForm((p) => ({ ...p, [k]: v }));

  const onSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!form.name || !form.email || !startDate) {
      toast({
        title: "Please complete required fields",
        description: "Name, email and start date are required.",
      });
      return;
    }
    const accLabel = {
      comfort: "Adventure Safari Lodges",
      luxury: "Comfort Safari Lodges",
      either: "Either (no preference)",
    }[form.accommodation as "comfort" | "luxury" | "either"];


    const msg =
      `${subject}\n` +
      `Name: ${form.name}\n` +
      `Email: ${form.email}\n` +
      `Phone: ${form.phone}\n` +
      `Country: ${form.country}\n` +
      `Pickup Date: ${format(startDate, "PPP")}\n` +
      `Accommodation: ${accLabel}\n` +
      `Adults: ${form.adults} · Children: ${form.children}\n` +
      `Message: ${form.message}`;

    window.open(whatsappLink(msg), "_blank");
    toast({
      title: "Enquiry sent!",
      description: "We'll reply within 1 hour.",
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
        <h3 className="text-base font-heading font-bold">Plan Your Safari</h3>
        <p className="text-xs text-muted-foreground mt-0.5">
          We reply within 1 hour · Free safari consultation
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

      <div>
        <label className="block text-xs font-heading font-bold mb-1.5 text-foreground">
          <CalIcon className="inline w-3.5 h-3.5 mr-1" />
          Pickup Date *
        </label>
        <Popover>
          <PopoverTrigger asChild>
            <Button
              type="button"
              variant="outline"
              className={cn(
                "w-full justify-start text-left font-normal text-sm h-[42px]",
                !startDate && "text-muted-foreground",
              )}
            >
              {startDate ? format(startDate, "PPP") : "Pick a date"}
            </Button>
          </PopoverTrigger>
          <PopoverContent className="w-auto p-0" align="start">
            <CalendarWidget
              mode="single"
              selected={startDate}
              onSelect={setStartDate}
              initialFocus
              className="p-3 pointer-events-auto"
              disabled={(d) => d < new Date()}
            />
          </PopoverContent>
        </Popover>
      </div>

      <div>
        <label className="block text-xs font-heading font-bold mb-1.5 text-foreground">
          <Bed className="inline w-3.5 h-3.5 mr-1" />
          Accommodation Preference
        </label>
        <select
          className={input}
          value={form.accommodation}
          onChange={(e) => upd("accommodation", e.target.value)}
        >
          <option value="either">Either (no preference)</option>
          <option value="comfort">Adventure Safari Lodges</option>
          <option value="luxury">Comfort Safari Lodges</option>
        </select>

      </div>

      <div className={cn("grid gap-3", compact ? "grid-cols-2" : "grid-cols-2")}>
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

      <textarea
        rows={3}
        className={input}
        placeholder="Your message (optional)"
        value={form.message}
        onChange={(e) => upd("message", e.target.value)}
      />

      <button
        type="submit"
        className="w-full bg-accent hover:brightness-110 text-accent-foreground font-heading font-bold rounded-full py-3 text-sm shadow-md transition-all"
      >
        Make a Booking →
      </button>

      <p className="text-[11px] text-muted-foreground text-center pt-1">
        📞 {PHONE} · {RESERVATIONS_EMAIL}
      </p>
    </form>
  );
};

export default BookingFormTour;
