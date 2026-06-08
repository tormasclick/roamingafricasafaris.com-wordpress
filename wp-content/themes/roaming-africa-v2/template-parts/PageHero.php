import { ReactNode } from "react";
import { getHeroImage } from "@/data/images";

interface PageHeroProps {
  children: ReactNode;
  imageKey?: string;
  imageUrl?: string;
}

const PageHero = ({ children, imageKey, imageUrl }: PageHeroProps) => {
  const bg = imageUrl || getHeroImage(imageKey || "masai-mara");
  return (
    <div className="relative h-40 md:h-56 overflow-hidden">
      <img
        src={bg}
        alt=""
        className="absolute inset-0 w-full h-full object-cover"
        loading="eager"
      />
      <div className="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/70" />
      <div className="relative z-10 h-full flex items-end">
        <div className="container mx-auto px-4 pb-6 [&_h1]:text-xl [&_h1]:md:text-3xl [&_h1]:font-heading [&_h1]:font-bold [&_h1]:text-primary-foreground [&_p]:text-sm [&_p]:md:text-base [&_p]:text-primary-foreground/90">
          {children}
        </div>
      </div>
    </div>
  );
};

export default PageHero;
