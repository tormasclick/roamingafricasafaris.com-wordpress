import { Link } from "react-router-dom";
import { CalendarCheck, MessageCircle, Phone } from "lucide-react";
import { whatsappLink, PHONE } from "@/data/constants";

const MobileActionBar = () => (
  <div className="fixed bottom-0 left-0 right-0 z-50 lg:hidden bg-popover border-t border-border shadow-[0_-4px_20px_rgba(0,0,0,0.1)]">
    <div className="grid grid-cols-3 h-16">
      <Link
        to="/booking"
        className="flex flex-col items-center justify-center gap-0.5 bg-accent text-accent-foreground font-heading font-bold text-xs"
      >
        <CalendarCheck className="w-5 h-5" />
        Book Now
      </Link>
      <a
        href={whatsappLink("Hi! I'd like to book a safari.")}
        target="_blank"
        rel="noopener noreferrer"
        className="flex flex-col items-center justify-center gap-0.5 text-xs font-heading font-bold"
        style={{ backgroundColor: "#25D366", color: "#fff" }}
      >
        <MessageCircle className="w-5 h-5" />
        WhatsApp
      </a>
      <a
        href={`tel:${PHONE.replace(/\s/g, "")}`}
        className="flex flex-col items-center justify-center gap-0.5 bg-primary text-primary-foreground text-xs font-heading font-bold"
      >
        <Phone className="w-5 h-5" />
        Call Us
      </a>
    </div>
  </div>
);

export default MobileActionBar;
