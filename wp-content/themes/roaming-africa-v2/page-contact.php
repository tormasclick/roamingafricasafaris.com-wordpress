import { Phone, Mail, MapPin, Clock, MessageCircle } from "lucide-react";
import { PHONE, PHONES, EMAIL, RESERVATIONS_EMAIL, ADDRESS, whatsappLink } from "@/data/constants";
import Breadcrumbs from "@/components/Breadcrumbs";
import SEO from "@/components/SEO";
import { Link } from "react-router-dom";

const Contact = () => (
  <>
    <SEO
      title="Contact Us | Book Your East Africa Safari — Roaming Africa Tours"
      description={`Contact Roaming Africa Tours & Safaris. Call ${PHONE}, email ${EMAIL} or reservations at ${RESERVATIONS_EMAIL}. We reply within 1 hour.`}
    />

    <div className="safari-gradient py-16">
      <div className="container mx-auto px-4 text-center">
        <h1 className="text-primary-foreground mb-4">Contact Us</h1>
        <p className="text-primary-foreground opacity-80 max-w-2xl mx-auto">We'd love to hear from you. Reach out via any of the channels below.</p>
      </div>
    </div>

    <div className="container mx-auto px-4">
      <Breadcrumbs items={[{ label: "Contact" }]} />
    </div>

    <div className="container mx-auto px-4 py-12">
      <div className="grid md:grid-cols-2 lg:grid-cols-5 gap-6 mb-12">
        {[
          { icon: Phone, title: "Telephone", detail: PHONES.join(" · "), action: `tel:${PHONE.replace(/\s/g, "")}` },
          { icon: Mail, title: "General Inquiries", detail: EMAIL, action: `mailto:${EMAIL}` },
          { icon: Mail, title: "Reservations", detail: RESERVATIONS_EMAIL, action: `mailto:${RESERVATIONS_EMAIL}` },
          { icon: MapPin, title: "Location", detail: ADDRESS, action: "#" },
          { icon: Clock, title: "Working Hours", detail: "Mon-Sat 8AM-6PM EAT", action: "#" },
        ].map(({ icon: Icon, title, detail, action }) => (
          <a key={title} href={action} className="bg-card border border-border rounded-xl p-6 text-center hover:shadow-lg transition-shadow block">
            <div className="w-14 h-14 mx-auto mb-3 rounded-full safari-gradient flex items-center justify-center">
              <Icon className="w-6 h-6 text-primary-foreground" />
            </div>
            <h3 className="text-base mb-1">{title}</h3>
            <p className="text-muted-foreground text-xs break-words">{detail}</p>
          </a>
        ))}
      </div>

      <div className="grid lg:grid-cols-2 gap-10">
        <div className="bg-card border border-border rounded-xl p-8">
          <h2 className="mb-6">Send Us a Message</h2>
          <form className="space-y-4" onSubmit={(e) => { e.preventDefault(); window.open(whatsappLink("Hi! I have a question about your safari services."), "_blank"); }}>
            <div className="grid md:grid-cols-2 gap-4">
              <input type="text" placeholder="Your Name" required className="w-full border border-border rounded-lg px-4 py-3 bg-background text-sm focus:ring-2 focus:ring-primary outline-none" />
              <input type="email" placeholder="Your Email" required className="w-full border border-border rounded-lg px-4 py-3 bg-background text-sm focus:ring-2 focus:ring-primary outline-none" />
            </div>
            <input type="text" placeholder="Subject" className="w-full border border-border rounded-lg px-4 py-3 bg-background text-sm focus:ring-2 focus:ring-primary outline-none" />
            <textarea rows={5} placeholder="Your Message" required className="w-full border border-border rounded-lg px-4 py-3 bg-background text-sm focus:ring-2 focus:ring-primary outline-none" />
            <div className="flex flex-col sm:flex-row gap-4">
              <button type="submit" className="bg-primary text-primary-foreground px-8 py-3 rounded-lg font-heading font-bold hover:brightness-110 transition-all">Send Message</button>
              <a href={whatsappLink("Hi! I have a question.")} target="_blank" rel="noopener noreferrer" className="whatsapp-btn justify-center">
                <MessageCircle className="w-5 h-5" /> WhatsApp Us
              </a>
            </div>
          </form>
        </div>

        <div>
          <h2 className="mb-4">Find Us</h2>
          <div className="bg-muted rounded-xl h-80 flex items-center justify-center mb-6">
            <iframe
              title="Roaming Africa Tours Location"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d255282.35853743174!2d36.68218!3d-1.30326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1172d84d49a7%3A0xf7cf0254b297924c!2sNairobi%2C%20Kenya!5e0!3m2!1sen!2s!4v1"
              className="w-full h-full rounded-xl"
              loading="lazy"
              allowFullScreen
            />
          </div>
          <Link to="/booking" className="block w-full bg-accent text-accent-foreground py-3 rounded-lg font-heading font-bold text-center hover:brightness-110 transition-all">
            Make a Booking
          </Link>
        </div>
      </div>
    </div>
  </>
);

export default Contact;
