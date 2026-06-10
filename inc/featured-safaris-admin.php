<?php
function featured_safaris_submenu() {
    add_submenu_page("edit.php?post_type=safari", "Featured Safaris Settings", "Settings", "manage_options", "featured-safaris-settings", "featured_safaris_settings_page");
}
add_action("admin_menu", "featured_safaris_submenu");

function featured_safaris_settings_page() {
    if(isset($_POST["save_settings"])) {
        update_option("featured_safaris_count", intval($_POST["safari_count"]));
        update_option("featured_safaris_title", sanitize_text_field($_POST["section_title"]));
        update_option("featured_safaris_subtitle", sanitize_textarea_field($_POST["section_subtitle"]));
        echo "<div class=\"notice notice-success\"><p>Settings saved!</p></div>";
    }
    
    $safari_count = get_option("featured_safaris_count", 4);
    $section_title = get_option("featured_safaris_title", "Best Featured Safari Deals");
    $section_subtitle = get_option("featured_safaris_subtitle", "Explore our most popular safari packages across East Africa. Each tour is carefully designed to showcase the best wildlife and landscapes.");
    ?>
    <div class="wrap">
        <h1>Featured Safaris Settings</h1>
        <form method="post">
            <table class="form-table">
                <tr><th>Number of Safaris</th><td><select name="safari_count"><?php for($i=1;$i<=30;$i++){echo "<option value=\"$i\"".($safari_count==$i?" selected":"").">$i".($i==1?" Safari":" Safaris")."</option>";}?></select><p class="description">How many safaris to show on homepage (1-30)</p></td></tr>
                <tr><th>Section Title</th><td><input type="text" name="section_title" value="<?php echo esc_attr($section_title); ?>" style="width:100%"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

                </th>
              </tr>
            </thead>
          </div>
        </div>
      </div>
    </div>
  </div>

                </th>
              </tr>
            </thead>
          </div>
        </div>
      </div>
    </div>
  </div>

            </td>
           </tr>
         </table>
        <p class="submit"><input type="submit" name="save_settings" class="button button-primary" value="Save Settings"></p>
    </form>
    </div>
    <?php
}

