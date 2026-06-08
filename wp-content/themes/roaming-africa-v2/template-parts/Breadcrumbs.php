import { Link } from "react-router-dom";
import { ChevronRight, Home } from "lucide-react";

interface BreadcrumbItem {
  label: string;
  href?: string;
}

const Breadcrumbs = ({ items }: { items: BreadcrumbItem[] }) => (
  <nav aria-label="Breadcrumb" className="py-3 px-4">
    <ol className="flex items-center gap-1 text-sm flex-wrap" itemScope itemType="https://schema.org/BreadcrumbList">
      <li itemProp="itemListElement" itemScope itemType="https://schema.org/ListItem">
        <Link to="/" className="text-muted-foreground hover:text-primary transition-colors flex items-center gap-1" itemProp="item">
          <Home className="w-3.5 h-3.5" />
          <span itemProp="name">Home</span>
        </Link>
        <meta itemProp="position" content="1" />
      </li>
      {items.map((item, i) => (
        <li key={i} className="flex items-center gap-1" itemProp="itemListElement" itemScope itemType="https://schema.org/ListItem">
          <ChevronRight className="w-3.5 h-3.5 text-muted-foreground" />
          {item.href ? (
            <Link to={item.href} className="text-muted-foreground hover:text-primary transition-colors" itemProp="item">
              <span itemProp="name">{item.label}</span>
            </Link>
          ) : (
            <span className="text-foreground font-medium" itemProp="name">{item.label}</span>
          )}
          <meta itemProp="position" content={String(i + 2)} />
        </li>
      ))}
    </ol>
  </nav>
);

export default Breadcrumbs;
