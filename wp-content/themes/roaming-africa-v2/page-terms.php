import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import Breadcrumbs from "@/components/Breadcrumbs";

const Terms = () => (
  <>
    <SEO
      title="Terms & Conditions | Roaming Africa Tours & Safaris"
      description="Booking terms, payment, cancellation and liability policies for Kenya, Tanzania and Zanzibar safaris operated by Roaming Africa Tours & Safaris."
    />

    <PageHero imageKey="masai-mara">
      <h1>Terms & Conditions</h1>
      <p>Booking terms governing all safaris, tours and services provided by Roaming Africa Tours & Safaris.</p>
    </PageHero>

    <div className="container mx-auto px-4">
      <Breadcrumbs items={[{ label: "Terms & Conditions" }]} />
    </div>

    <article className="container mx-auto px-4 py-10 max-w-3xl prose prose-sm prose-headings:font-heading prose-headings:font-bold prose-p:text-muted-foreground">
      <h2>Reservations & Confirmations</h2>
      <p>A deposit of 50% is required at the time of booking. The balance is due 45 days before commencement of the tour program. A booking is considered confirmed upon receiving a deposit of 50% of travel cost. If the reservation is made within 45 days of departure the whole amount must be paid at the time of confirmation.</p>
      <p>We prefer payments by Wire Transfers through bank, which are subject to bank charges at the prevailing/current rate. We also accept payments via debit/credit card i.e. MasterCard, VISA and American Express through PesaPal-Merchant processing. An invoice will be sent to you when you are ready to start the booking process with us. All prices are quoted in US$ Dollars. Local currency can be accepted at the current dollar-buying rate.</p>

      <h2>Cancellation & Refund Policy</h2>
      <p>Any monies paid will be refunded less the cost of cancellation fees levied by hotels or food expenses. Rates include all expenses in respect of vehicle and driver as per itinerary, meals on safari, entrance fees to National Parks and Game Reserves.</p>
      <p>Reservations/Bookings that are cancelled, reduced in length of stay or reduced in numbers of participants (hereinafter collectively called CANCELLATION) are subject to cancellation and No-Show fees. The scale of charges, expressed as a percentage of the tour prices, is as follows:</p>
      <ul>
        <li>Cancellations made more than 30 days before the start date: Full refund less administrative fees.</li>
        <li>Cancellations made between 29 and 3 days before the start date: 50% refund.</li>
        <li>Cancellations made within 48 hours of the start date or on the day of travel are non-refundable.</li>
      </ul>
      <p><strong>Please Note:</strong> Vehicle images shown on our website are for illustrative purposes; exact models and specifications may vary depending on operational needs.</p>
      <p>Should you fail to join a tour or join it after departure or leave prior to its completion, no tour fare refund can be made. (Please note that if the reason for the cancellation falls within the terms of any holiday insurance policy, which you hold, then the insurance company, subject to the terms of your insurance will normally refund any such charges to you).</p>

      <h2>Transportation</h2>
      <p>Well maintained Vehicles, 4WD Land Cruisers and 4×4 Toyota Minibuses/Tour Vans with pop up roof that are rebuilt for safari, Overland Safari Trucks and excellent cars, Station wagons or Coaches for transfers will be provided according to the route and number of participants as per quotation in the itinerary. However Roaming Africa Tours & Safaris has discretion to use other type of vehicle in case conditions necessitate. Roaming Africa Tours & Safaris reserves the right to employ the services of subcontractors. English-speaking driver/guides are provided.</p>

      <h2>Accommodation</h2>
      <p>Based on two persons sharing a double/twin room. Single rooms are available at an additional cost but cannot be guaranteed. Hotels/lodges are named as an indication of category and rooms may be reserved at similar hotels/lodges depending on availability.</p>

      <h2>Alteration to Tours</h2>
      <p>Roaming Africa Tours & Safaris reserves the right to alter arrangements or cancel the operation of a scheduled tour should conditions necessitate. It also reserves the right to decline to accept or retain any person as a member of any tour at anytime, in which case an equitable amount will be refunded. Prices are based on tariffs and other costs prevailing at the time of reservation and are subject to change without notice.</p>

      <h2>Liability</h2>
      <p>Roaming Africa Tours & Safaris only acts as agents of the tours, transport, etc. and shall not be liable for injury, delays, loss or damage in any manner. Roaming Africa Tours & Safaris' liability to passengers carried in its own vehicle is governed by the laws of the country in which the tour takes place and no other country. All claims are subject to the jurisdiction of the courts of the country in which the actions arise. The company reserves the right to employ subcontractors for all or part of the services. Roaming Africa Tours & Safaris shall not be held responsible for loss or damages to luggage.</p>

      <p className="text-xs italic mt-8">Last updated: 2026</p>
    </article>
  </>
);

export default Terms;
