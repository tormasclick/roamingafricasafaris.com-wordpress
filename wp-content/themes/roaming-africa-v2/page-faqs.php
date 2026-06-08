import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import Breadcrumbs from "@/components/Breadcrumbs";
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";

const faqs = [
  { question: "How do I book a safari with Roaming Africa Tours?", answer: "Send an enquiry via our website, WhatsApp or email. Our reservations team replies within 1 hour with a tailored proposal. Once you confirm, a 30% deposit secures your booking and the balance is due 45 days before arrival." },
  { question: "What is the best time to visit Kenya and Tanzania?", answer: "Year-round safaris are possible. The dry seasons (June–October and January–February) offer the best wildlife viewing. The Great Migration river crossings in the Mara peak July–October, while calving season in the southern Serengeti runs January–March." },
  { question: "Do I need a visa to enter Kenya or Tanzania?", answer: "Most nationalities require an e-visa for Kenya (apply at evisa.go.ke) and a visa-on-arrival or e-visa for Tanzania. We provide visa support letters and step-by-step guidance with every booking." },
  { question: "What vaccinations are required?", answer: "Yellow Fever vaccination is required if travelling from a Yellow Fever endemic country. Routine vaccinations (Hepatitis A, Typhoid, Tetanus) and malaria prophylaxis are strongly recommended. Always consult your travel doctor." },
  { question: "What is included in the safari price?", answer: "Standard inclusions: accommodation on full-board basis, professional driver-guide, 4×4 safari vehicle with pop-up roof, all park and conservancy fees, bottled water in the vehicle, and airport transfers. International flights, visas, tips and personal expenses are excluded." },
  { question: "Is it safe to travel to Kenya and Tanzania?", answer: "Yes. Tourist areas, national parks and lodges are well-managed and safe. Our drivers are highly trained, vehicles are fitted with two-way radios, and every booking includes AMREF Flying Doctors evacuation cover." },
  { question: "Can you accommodate dietary requirements and disabilities?", answer: "Yes. We cater for vegetarian, vegan, halal, kosher, gluten-free and allergy-specific diets. We also operate dedicated accessible safaris with adapted vehicles, accessible lodges and trained guides — see our Kenya Disability Tours page." },
  { question: "What is your cancellation policy?", answer: "Cancellations 60+ days before arrival: deposit refund minus a 10% admin fee. 30–59 days: 50% refund. Less than 30 days: no refund. We strongly recommend comprehensive travel insurance covering cancellation, medical and evacuation." },
  { question: "How much should I tip on safari?", answer: "Tipping is discretionary but appreciated. Guidelines: USD 15–25 per day for your safari guide, USD 5–10 per day for lodge staff (pooled), and USD 5 per transfer for transfer drivers." },
  { question: "Do you organise honeymoon and family safaris?", answer: "Absolutely. Honeymooners enjoy upgraded suites, private dining and complimentary champagne. Family safaris use family-room configurations, child-friendly guides and age-appropriate activities including junior ranger programmes." },
];

const FAQs = () => {
  const jsonLd = {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    mainEntity: faqs.map((f) => ({
      "@type": "Question",
      name: f.question,
      acceptedAnswer: { "@type": "Answer", text: f.answer },
    })),
  };

  return (
    <>
      <SEO
        title="Safari FAQs | Kenya & Tanzania Travel Questions Answered"
        description="Answers to the most common questions about Kenya and Tanzania safaris — visas, vaccinations, best time to visit, pricing, safety, tipping, cancellation and more."
        canonical="https://every-page-grabber.lovable.app/faqs"
        jsonLd={jsonLd}
      />

      <PageHero imageKey="masai-mara">
        <h1>Frequently Asked Questions</h1>
        <p>Everything you need to know to plan your Kenya or Tanzania safari with confidence.</p>
      </PageHero>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: "FAQs" }]} />
      </div>

      <div className="container mx-auto px-4 py-10 max-w-3xl">
        <Accordion type="single" collapsible className="w-full">
          {faqs.map((f, i) => (
            <AccordionItem key={i} value={`faq-${i}`}>
              <AccordionTrigger className="text-left text-sm font-heading">{f.question}</AccordionTrigger>
              <AccordionContent className="text-muted-foreground text-sm leading-relaxed">{f.answer}</AccordionContent>
            </AccordionItem>
          ))}
        </Accordion>
      </div>
    </>
  );
};

export default FAQs;
