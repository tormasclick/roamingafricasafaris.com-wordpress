import { Link } from "react-router-dom";
import { Phone, Mail, Facebook, Instagram, Twitter, Youtube } from "lucide-react";
import { PHONES, EMAIL, RESERVATIONS_EMAIL, COMPANY, SOCIAL } from "@/data/constants";

const kenyaCol = [
  { label: "Maasai Mara", href: "/destination/masai-mara" },
  { label: "Amboseli", href: "/destination/amboseli" },
  { label: "Lake Nakuru", href: "/destination/lake-nakuru" },
  { label: "Ol Pejeta", href: "/destination/ol-pejeta-conservancy" },
  { label: "Tsavo", href: "/destination/tsavo-east" },
  { label: "Lake Naivasha", href: "/destination/lake-naivasha" },
];

const tanzaniaCol = [
  { label: "Serengeti", href: "/destination/serengeti-national-park" },
  { label: "Ngorongoro", href: "/destination/ngorongoro-crater" },
  { label: "Lake Manyara", href: "/destination/lake-manyara" },
  { label: "Mikumi", href: "/destination/mikumi-national-park" },
  { label: "Grumeti Game Reserve", href: "/destination/grumeti-game-reserve" },
  { label: "Nyerere National Park", href: "/destination/nyerere-national-park" },
  { label: "Zanzibar", href: "/destination/zanzibar" },
  { label: "Arusha", href: "/destination/arusha" },
];

const quickLinksCol = [
  { label: "Great Migration Safaris", href: "/great-migration-safaris" },
  { label: "Incentive Safaris Kenya Tanzania", href: "/incentive-safaris-kenya-tanzania" },
  { label: "Kenya Tanzania DMC", href: "/kenya-tanzania-dmc" },
  { label: "Kenya Disability Tours", href: "/kenya-safaris/accessible" },
  { label: "Helicopter Tours", href: "/kenya-safaris/helicopter" },
  
  { label: "Terms & Conditions", href: "/terms" },
];

const resourcesCol = [
  { label: "Kenya Travel Guide", href: "/resources/kenya-safari-guide" },
  { label: "Tanzania Travel Guide", href: "/resources/tanzania-travel-guide" },
];

const Footer = () => (
  <footer className="relative text-white overflow-hidden" style={{ backgroundColor: "rgb(41, 135, 66)" }}>
    <div className="relative container mx-auto px-4 py-12">

      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
        {/* Column 1 - Get In Touch */}
        <div>
          <h3 className="text-base mb-3 text-white font-heading font-bold uppercase tracking-wide">Get In Touch</h3>
          <address className="not-italic text-xs opacity-95 mb-4 leading-relaxed">
            2nd Floor, Country Arcade<br />
            Ngong Road, Nairobi, Kenya – East Africa<br />
            P.O. Box 40-50105<br />
            Nairobi, Kenya
          </address>

          <ul className="space-y-2 text-xs mb-4">
            {PHONES.map((p) => (
              <li key={p} className="flex items-center gap-2 opacity-90"><Phone className="w-3.5 h-3.5" /><a href={`tel:${p.replace(/\s/g, "")}`} className="hover:underline">{p}</a></li>
            ))}
            <li className="flex items-center gap-2 opacity-90"><Mail className="w-3.5 h-3.5" /><a href={`mailto:${EMAIL}`} className="hover:underline">{EMAIL}</a></li>
            <li className="flex items-center gap-2 opacity-90"><Mail className="w-3.5 h-3.5" /><a href={`mailto:${RESERVATIONS_EMAIL}`} className="hover:underline">{RESERVATIONS_EMAIL}</a></li>
          </ul>
          <div className="flex gap-2 mb-4">
            <a href={SOCIAL.facebook} aria-label="Facebook" target="_blank" rel="noopener noreferrer" className="w-8 h-8 rounded-full bg-white/15 hover:bg-white/30 flex items-center justify-center"><Facebook className="w-3.5 h-3.5" /></a>
            <a href={SOCIAL.twitter} aria-label="X" target="_blank" rel="noopener noreferrer" className="w-8 h-8 rounded-full bg-white/15 hover:bg-white/30 flex items-center justify-center"><Twitter className="w-3.5 h-3.5" /></a>
            <a href={SOCIAL.youtube} aria-label="YouTube" target="_blank" rel="noopener noreferrer" className="w-8 h-8 rounded-full bg-white/15 hover:bg-white/30 flex items-center justify-center"><Youtube className="w-3.5 h-3.5" /></a>
            <a href={SOCIAL.instagram} aria-label="Instagram" target="_blank" rel="noopener noreferrer" className="w-8 h-8 rounded-full bg-white/15 hover:bg-white/30 flex items-center justify-center"><Instagram className="w-3.5 h-3.5" /></a>
          </div>
          <div>
            <h4 className="text-xs font-heading font-bold mb-2 uppercase tracking-wide">Payments</h4>
            <div className="flex flex-wrap gap-2 items-center">
              <img src="https://img.icons8.com/color/48/visa.png" alt="Visa" className="h-6 bg-white rounded px-1" loading="lazy" />
              <img src="https://img.icons8.com/color/48/mastercard.png" alt="Mastercard" className="h-6 bg-white rounded px-1" loading="lazy" />
              <span className="bg-white/20 text-white text-[10px] font-heading font-bold px-2 py-1 rounded-full">M-Pesa</span>
            </div>
          </div>
        </div>

        <div>
          <h3 className="text-base mb-3 text-white font-heading font-bold uppercase tracking-wide">Explore Kenya</h3>
          <ul className="space-y-1.5 text-xs">
            {kenyaCol.map((l) => (
              <li key={l.label}><Link to={l.href} className="opacity-90 hover:opacity-100 hover:underline">{l.label}</Link></li>
            ))}
          </ul>
        </div>

        <div>
          <h3 className="text-base mb-3 text-white font-heading font-bold uppercase tracking-wide">Explore Tanzania</h3>
          <ul className="space-y-1.5 text-xs">
            {tanzaniaCol.map((l) => (
              <li key={l.label}><Link to={l.href} className="opacity-90 hover:opacity-100 hover:underline">{l.label}</Link></li>
            ))}
          </ul>
        </div>

        <div>
          <h3 className="text-base mb-3 text-white font-heading font-bold uppercase tracking-wide">Quick Links</h3>
          <ul className="space-y-1.5 text-xs">
            {quickLinksCol.map((l) => (
              <li key={l.label}><Link to={l.href} className="opacity-90 hover:opacity-100 hover:underline">{l.label}</Link></li>
            ))}
          </ul>
        </div>

        <div>
          <h3 className="text-base mb-3 text-white font-heading font-bold uppercase tracking-wide">Resources</h3>
          <ul className="space-y-1.5 text-xs">
            {resourcesCol.map((l) => (
              <li key={l.label}><Link to={l.href} className="opacity-90 hover:opacity-100 hover:underline">{l.label}</Link></li>
            ))}
          </ul>
        </div>
      </div>
    </div>
    <div className="relative border-t border-white/20">
      <div className="container mx-auto px-4 py-4 text-center text-xs opacity-80">
        © {new Date().getFullYear()} {COMPANY} | All Rights Reserved
      </div>
    </div>
  </footer>
);

export default Footer;
