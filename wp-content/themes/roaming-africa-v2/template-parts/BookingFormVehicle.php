import { useState } from "react";
import { Calendar as CalIcon, User, Mail, Phone, Globe } from "lucide-react";
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
  subject?: string;
  heading?: string;
  ctaLabel?: string;
  className?: string;
}

/**
 * Vehicle hire booking form — Name, Email, Phone, Country,
 * Pickup Date, Return Date, Message.
 * Deliberately omits Room Type / Number of Rooms / Accommodation Preference.
 */
const BookingFormVehicle = ({
  subject = "Vehicle Booking Request",
  heading = "Make a Booking",
  ctaLabel = "Make a Booking",
  className,
}: Props) => {
  const [pickup, setPickup] = useState<Date>();
  const [ret, setRet] = useState<Date>();
  const [form, setForm] = useState({
    name: "", email: "", phone: "", country: "", message: "",
  });

  const upd = (k: string, v: string) => setForm((p) => ({ ...p, [k]: v }));

  const onSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!form.name || !form.email || !pickup || !ret) {
      toast({
        title: "Please complete required fields",
        description: "Name, email, pickup and return dates are required.",
      });
      return;
    }
    const msg =
      `${subject}\n` +
      `Name: ${form.name}\n` +
      `Email: ${form.email}\n` +
      `Phone: ${form.phone}\n` +
      `Country: ${form.country}\n` +
      `Pickup: ${format(pickup, "PPP")}\n` +
      `Return: ${format(ret, "PPP")}\n` +
      `Message: ${form.message}`;
    window.open(whatsappLink(msg), "_blank");
    toast({
      title: "Booking request sent!",
      description: "Our reservations team will confirm within 1 hour.",
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
          Driver, fuel & insurance included
        </p>
      </div>

      <div className="relative">
        <User className="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-muted-foreground" />
        <input className={`${input} pl-9`} placeholder="Your Full Name *" value={form.name} onChange={(e) => upd("name", e.target.value)} required />
      </div>
      <div className="relative">
        <Mail className="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-muted-foreground" />
        <input type="email" className={`${input} pl-9`} placeholder="Email Address *" value={form.email} onChange={(e) => upd("email", e.target.value)} required />
      </div>
      <div className="relative">
        <Phone className="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-muted-foreground" />
        <input type="tel" className={`${input} pl-9`} placeholder="Phone Number" value={form.phone} onChange={(e) => upd("phone", e.target.value)} />
      </div>
      <div className="relative">
        <Globe className="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-muted-foreground" />
        <select className={`${input} pl-9`} value={form.country} onChange={(e) => upd("country", e.target.value)}>
          <option value="">Select Country</option>
          {COUNTRIES.map((c) => <option key={c} value={c}>{c}</option>)}
        </select>
      </div>

      <div className="grid grid-cols-2 gap-3">
        <div>
          <label className="block text-xs font-heading font-bold mb-1.5"><CalIcon className="inline w-3.5 h-3.5 mr-1" />Pickup Date *</label>
          <Popover>
            <PopoverTrigger asChild>
              <Button type="button" variant="outline" className={cn("w-full justify-start text-left font-normal text-xs h-[42px] px-2", !pickup && "text-muted-foreground")}>
                {pickup ? format(pickup, "MMM d") : "Pick date"}
              </Button>
            </PopoverTrigger>
            <PopoverContent className="w-auto p-0" align="start">
              <CalendarWidget mode="single" selected={pickup} onSelect={setPickup} initialFocus className="p-3 pointer-events-auto" disabled={(d) => d < new Date()} />
            </PopoverContent>
          </Popover>
        </div>
        <div>
          <label className="block text-xs font-heading font-bold mb-1.5"><CalIcon className="inline w-3.5 h-3.5 mr-1" />Return Date *</label>
          <Popover>
            <PopoverTrigger asChild>
              <Button type="button" variant="outline" className={cn("w-full justify-start text-left font-normal text-xs h-[42px] px-2", !ret && "text-muted-foreground")}>
                {ret ? format(ret, "MMM d") : "Pick date"}
              </Button>
            </PopoverTrigger>
            <PopoverContent className="w-auto p-0" align="start">
              <CalendarWidget mode="single" selected={ret} onSelect={setRet} initialFocus className="p-3 pointer-events-auto" disabled={(d) => d < (pickup || new Date())} />
            </PopoverContent>
          </Popover>
        </div>
      </div>

      <textarea rows={3} className={input} placeholder="Tell us your route, group size and any special requests" value={form.message} onChange={(e) => upd("message", e.target.value)} />

      <button type="submit" className="w-full bg-accent hover:brightness-110 text-accent-foreground font-heading font-bold rounded-full py-3 text-sm shadow-md transition-all">
        {ctaLabel}
      </button>

      <p className="text-[11px] text-muted-foreground text-center pt-1">
        📞 {PHONE} · {EMAIL}
      </p>
    </form>
  );
};

export default BookingFormVehicle;
