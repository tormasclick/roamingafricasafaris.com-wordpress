<?php
if(!get_option('roaming_planner_enabled', true)) return;

$planner_title = get_option('roaming_planner_title', 'Plan Your Safari');
$destinations = get_option('roaming_planner_destinations', array('Kenya Safari', 'Tanzania Safari', 'Zanzibar Beach', 'Combo Safari'));
?>
<section id="safari-planner" class="relative -mt-10 z-20 px-4">
    <div class="container mx-auto max-w-5xl bg-white rounded-2xl shadow-2xl p-6 border border-gray-200">
        <h2 class="text-xl text-center mb-4 font-heading font-bold"><?php echo esc_html($planner_title); ?></h2>
        
        <form id="safari-planner-form" method="get" action="/booking">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Destination -->
                <div>
                    <label class="text-xs font-heading font-bold text-gray-600 mb-1 block">Destination</label>
                    <div class="flex items-center gap-2 border rounded-lg px-3 py-2.5 bg-white">
                        <i class="fas fa-map-marker-alt text-[#298742]"></i>
                        <select name="destination" class="text-sm bg-transparent outline-none w-full" required>
                            <option value="">Choose destination</option>
                            <?php foreach($destinations as $dest): ?>
                                <option value="<?php echo esc_attr($dest); ?>"><?php echo esc_html($dest); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <!-- Travel Date -->
                <div>
                    <label class="text-xs font-heading font-bold text-gray-600 mb-1 block">Travel Date</label>
                    <div class="flex items-center gap-2 border rounded-lg px-3 py-2.5 bg-white">
                        <i class="fas fa-calendar text-[#298742]"></i>
                        <input type="date" name="travel_date" class="text-sm bg-transparent outline-none w-full" min="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                
                <!-- Adults -->
                <div>
                    <label class="text-xs font-heading font-bold text-gray-600 mb-1 block">Adults</label>
                    <div class="flex items-center gap-2 border rounded-lg px-3 py-2.5 bg-white">
                        <i class="fas fa-users text-[#298742]"></i>
                        <input type="number" name="adults" value="2" min="1" max="20" class="text-sm bg-transparent outline-none w-full">
                    </div>
                </div>
                
                <!-- Children -->
                <div>
                    <label class="text-xs font-heading font-bold text-gray-600 mb-1 block">Children</label>
                    <div class="flex items-center gap-2 border rounded-lg px-3 py-2.5 bg-white">
                        <i class="fas fa-child text-[#298742]"></i>
                        <input type="number" name="children" value="0" min="0" max="10" class="text-sm bg-transparent outline-none w-full">
                    </div>
                </div>
            </div>
            
            <div class="mt-4 flex justify-center">
                <button type="submit" class="bg-[#F5A623] text-[#2D2D2D] px-8 py-3 rounded-full font-heading font-bold flex items-center gap-2 hover:brightness-110 transition-all shadow-md">
                    <i class="fas fa-search"></i> Make a Booking
                </button>
            </div>
        </form>
    </div>
</section>

<script>
jQuery(document).ready(function($) {
    $('#safari-planner-form').on('submit', function(e) {
        var destination = $('select[name="destination"]').val();
        if(!destination) {
            e.preventDefault();
            alert('Please select a destination');
            return false;
        }
    });
});
</script>
