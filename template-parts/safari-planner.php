<?php
$planner_enabled = get_option('roaming_planner_enabled', true);
if(!$planner_enabled) return;

$booking_url = get_option('roaming_planner_booking_url', '/booking');

$travel_categories = array(
    'Kenya Safari',
    'Tanzania Safari',
    'Zanzibar Beach Holiday',
    'Kenya & Tanzania Combined Safari',
    'Mombasa Beach Holiday',
    'Diani Beach Holiday',
    'Watamu Beach Holiday',
    'Malindi Beach Holiday'
);
?>

<section id="safari-planner" style="position: relative; margin-top: -40px; z-index: 20; padding: 0 16px;">
    <div style="max-width: 1024px; margin: 0 auto; background: white; border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.02); padding: 32px 24px;">
        <h2 style="text-align: center; margin-bottom: 24px; font-size: 24px; font-weight: 700; color: #1a3c2c;">Plan Your Safari</h2>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
            <!-- Destination -->
            <div>
                <label style="display: block; font-size: 12px; font-weight: 700; color: #4b5563; margin-bottom: 6px;">Destination</label>
                <div style="display: flex; align-items: center; gap: 10px; border: 1px solid #e5e7eb; border-radius: 12px; padding: 10px 14px; background: white; transition: all 0.2s;">
                    <i class="fas fa-map-marker-alt" style="color: #298742; font-size: 16px;"></i>
                    <select id="planner-destination" style="font-size: 14px; background: transparent; outline: none; width: 100%; border: none;">
                        <option value="">Choose a holiday type</option>
                        <?php foreach($travel_categories as $cat): ?>
                            <option value="<?php echo esc_attr($cat); ?>"><?php echo esc_html($cat); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <!-- Travel Date -->
            <div>
                <label style="display: block; font-size: 12px; font-weight: 700; color: #4b5563; margin-bottom: 6px;">Travel Date</label>
                <div style="display: flex; align-items: center; gap: 10px; border: 1px solid #e5e7eb; border-radius: 12px; padding: 10px 14px; background: white;">
                    <i class="fas fa-calendar-alt" style="color: #298742; font-size: 16px;"></i>
                    <input type="date" id="planner-date" style="font-size: 14px; background: transparent; outline: none; width: 100%; border: none;" min="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
            
            <!-- Adults -->
            <div>
                <label style="display: block; font-size: 12px; font-weight: 700; color: #4b5563; margin-bottom: 6px;">Adults</label>
                <div style="display: flex; align-items: center; gap: 10px; border: 1px solid #e5e7eb; border-radius: 12px; padding: 10px 14px; background: white;">
                    <i class="fas fa-users" style="color: #298742; font-size: 16px;"></i>
                    <input type="number" id="planner-adults" min="1" max="20" value="2" style="font-size: 14px; background: transparent; outline: none; width: 100%; border: none;">
                </div>
            </div>
            
            <!-- Children -->
            <div>
                <label style="display: block; font-size: 12px; font-weight: 700; color: #4b5563; margin-bottom: 6px;">Children</label>
                <div style="display: flex; align-items: center; gap: 10px; border: 1px solid #e5e7eb; border-radius: 12px; padding: 10px 14px; background: white;">
                    <i class="fas fa-child" style="color: #298742; font-size: 16px;"></i>
                    <input type="number" id="planner-children" min="0" max="10" value="0" style="font-size: 14px; background: transparent; outline: none; width: 100%; border: none;">
                </div>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 32px;">
            <button id="planner-submit" style="background: #F5A623; color: #1a3c2c; padding: 14px 36px; border-radius: 50px; font-weight: 700; font-size: 16px; display: inline-flex; align-items: center; gap: 10px; border: none; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(245, 166, 35, 0.3);">
                <i class="fas fa-search" style="font-size: 16px;"></i> Make a Booking
            </button>
        </div>
    </div>
</section>

<style>
#planner-submit:hover {
    background: #e09510;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(245, 166, 35, 0.4);
}
#planner-submit:active {
    transform: translateY(0);
}
#safari-planner select:hover, 
#safari-planner input:hover {
    border-color: #298742 !important;
}
#safari-planner select:focus, 
#safari-planner input:focus {
    border-color: #298742 !important;
    box-shadow: 0 0 0 3px rgba(41, 135, 66, 0.1);
}
@media (max-width: 768px) {
    #safari-planner > div > div:first-of-type {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 15px !important;
    }
}
@media (max-width: 640px) {
    #safari-planner > div > div:first-of-type {
        grid-template-columns: 1fr !important;
    }
    #safari-planner > div {
        padding: 24px 20px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.getElementById('planner-submit');
    if(submitBtn) {
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const destination = document.getElementById('planner-destination').value;
            const travelDate = document.getElementById('planner-date').value;
            const adults = document.getElementById('planner-adults').value;
            const children = document.getElementById('planner-children').value;
            
            const params = new URLSearchParams();
            if(destination && destination !== '') params.set('destination', destination);
            if(travelDate) params.set('date', travelDate);
            if(adults) params.set('adults', adults);
            if(children) params.set('children', children);
            
            let url = '<?php echo esc_url($booking_url); ?>';
            const queryString = params.toString();
            if(queryString) url += '?' + queryString;
            
            window.location.href = url;
        });
    }
});
</script>
