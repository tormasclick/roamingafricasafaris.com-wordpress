import { useState } from "react";
import { Calendar as CalIcon, Send, MessageCircle, User, Mail, Phone, Globe, Users } from "lucide-react";
import { whatsappLink } from "@/data/constants";
import Breadcrumbs from "@/components/Breadcrumbs";
import SEO from "@/components/SEO";
import { toast } from "@/hooks/use-toast";
import { cn } from "@/lib/utils";
import { format } from "date-fns";
import { Popover, PopoverContent, PopoverTrigger } from "@/components/ui/popover";
import { Calendar as CalendarWidget } from "@/components/ui/calendar";
import { Button } from "@/components/ui/button";

const Booking = () => {
  const [startDate, setStartDate] = useState<Date>();
  const [endDate, setEndDate] = useState<Date>();
  const [form, setForm] = useState({
    name: "", email: "", phone: "", country: "",
    adults: "2", children: "0", message: "",
  });

  const update = (k: string, v: string) => setForm((p) => ({ ...p, [k]: v }));

  const onSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!form.name || !form.email) {
      toast({ title: "Please complete required fields", description: "Name and email are required." });
      return;
    }
    const msg = `Custom Quote Request\nName: ${form.name}\nEmail: ${form.email}\nPhone: ${form.phone}\nCountry: ${form.country}\nStart: ${startDate ? format(startDate, "PPP") : "TBD"}\nEnd: ${endDate ? format(endDate, "PPP") : "TBD"}\nAdults: ${form.adults} · Children: ${form.children}\nMessage: ${form.message}`;
    window.open(whatsappLink(msg), "_blank");
    toast({ title: "Request sent!", description: "We'll reply within 1 hour." });
  };

  const input = "w-full border border-border rounded-lg px-3 py-2.5 bg-background text-sm focus:ring-2 focus:ring-primary outline-none";
  const label = "block text-xs font-heading font-bold mb-1.5 text-foreground";

  return (
    <>
      <SEO title="Request a Custom Safari Quote | Tell Us About You" description="Get a tailored safari quote within 1 hour. Tell us about your trip — destinations, dates, party size — and our DMC team will craft your itinerary." />

      <div className="safari-gradient py-10">
        <div className="container mx-auto px-4 text-center">
          <h1 className="text-primary-foreground mb-2 text-2xl md:text-3xl">Make an Inquiry</h1>
          <p className="text-primary-foreground/90 text-sm">Speak with our safari specialists and receive a customized response for your travel plans.</p>
        </div>
      </div>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: "Plan My Safari" }]} />
      </div>

      <div className="container mx-auto px-4 pb-16 pt-4">
        <form
          onSubmit={onSubmit}
          className="max-w-3xl mx-auto bg-card border border-border rounded-2xl p-6 md:p-8 shadow-sm space-y-5"
        >
          <div className="grid md:grid-cols-2 gap-5">
            <div>
              <label className={label}><User className="inline w-3.5 h-3.5 mr-1" />Your Name *</label>
              <input className={input} value={form.name} onChange={(e) => update("name", e.target.value)} required />
            </div>
            <div>
              <label className={label}><Mail className="inline w-3.5 h-3.5 mr-1" />Email Address *</label>
              <input type="email" className={input} value={form.email} onChange={(e) => update("email", e.target.value)} required />
            </div>
            <div>
              <label className={label}><Phone className="inline w-3.5 h-3.5 mr-1" />Phone Number</label>
              <input type="tel" className={input} value={form.phone} onChange={(e) => update("phone", e.target.value)} placeholder="+1 234 567 890" />
            </div>
            <div>
              <label className={label}><Globe className="inline w-3.5 h-3.5 mr-1" />Select Country</label>
              <input className={input} value={form.country} onChange={(e) => update("country", e.target.value)} placeholder="e.g. United States" />
            </div>
            <div>
              <label className={label}><CalIcon className="inline w-3.5 h-3.5 mr-1" />Start Date</label>
              <Popover>
                <PopoverTrigger asChild>
                  <Button variant="outline" className={cn("w-full justify-start text-left font-normal text-sm h-[42px]", !startDate && "text-muted-foreground")}>
                    {startDate ? format(startDate, "PPP") : "Pick a date"}
                  </Button>
                </PopoverTrigger>
                <PopoverContent className="w-auto p-0" align="start">
                  <CalendarWidget mode="single" selected={startDate} onSelect={setStartDate} initialFocus className="p-3 pointer-events-auto" disabled={(d) => d < new Date()} />
                </PopoverContent>
              </Popover>
            </div>
            <div>
              <label className={label}><CalIcon className="inline w-3.5 h-3.5 mr-1" />End Date</label>
              <Popover>
                <PopoverTrigger asChild>
                  <Button variant="outline" className={cn("w-full justify-start text-left font-normal text-sm h-[42px]", !endDate && "text-muted-foreground")}>
                    {endDate ? format(endDate, "PPP") : "Pick a date"}
                  </Button>
                </PopoverTrigger>
                <PopoverContent className="w-auto p-0" align="start">
                  <CalendarWidget mode="single" selected={endDate} onSelect={setEndDate} initialFocus className="p-3 pointer-events-auto" disabled={(d) => d < (startDate || new Date())} />
                </PopoverContent>
              </Popover>
            </div>
            <div>
              <label className={label}><Users className="inline w-3.5 h-3.5 mr-1" />Number of Adults</label>
              <input type="number" min="1" className={input} value={form.adults} onChange={(e) => update("adults", e.target.value)} />
            </div>
            <div>
              <label className={label}><Users className="inline w-3.5 h-3.5 mr-1" />Number of Children</label>
              <input type="number" min="0" className={input} value={form.children} onChange={(e) => update("children", e.target.value)} />
            </div>
          </div>
          <div>
            <label className={label}>Your Message (Optional)</label>
            <textarea rows={4} className={input} value={form.message} onChange={(e) => update("message", e.target.value)} placeholder="Tell us about your dream safari, interests, accommodation preferences..." />
          </div>

          <div className="flex flex-col sm:flex-row gap-3 pt-2">
            <button type="submit" className="inline-flex items-center justify-center gap-2 bg-accent text-accent-foreground px-6 py-3 rounded-full font-heading font-bold text-sm hover:brightness-110 transition-all shadow-md flex-1">
              <Send className="w-4 h-4" /> Request a Custom Quote
            </button>
            <a
              href={whatsappLink("Hi! I'd like a custom safari quote.")}
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center justify-center gap-2 bg-[#25D366] text-white px-6 py-3 rounded-full font-heading font-bold text-sm hover:brightness-110 transition-all shadow-md"
            >
              <MessageCircle className="w-4 h-4" /> WhatsApp
            </a>
          </div>
        </form>
      </div>
    </>
  );
};

export default Booking;
