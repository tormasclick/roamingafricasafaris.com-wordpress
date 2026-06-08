import { MessageCircle } from "lucide-react";
import { whatsappLink } from "@/data/constants";

const WhatsAppFloat = () => (
  <a
    href={whatsappLink("Hello! I'm interested in booking a safari with Roaming Africa Tours.")}
    target="_blank"
    rel="noopener noreferrer"
    className="fixed bottom-20 lg:bottom-6 right-6 z-50 whatsapp-btn rounded-full p-4 shadow-lg hover:shadow-xl"
    aria-label="Chat on WhatsApp"
  >
    <MessageCircle className="w-7 h-7" />
  </a>
);

export default WhatsAppFloat;
