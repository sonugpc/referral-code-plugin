<?php
/* Template Name: Store Referral Code Layout */
get_header();
?>

<div class="referral-wrapper" style="max-width:900px;margin:0 auto;padding:16px; font-family:Arial, sans-serif;">
  <!-- TOP SECTION: Logo, Name, Category, Rating -->
  <div style="display:flex;align-items:center;border-bottom:1px solid #eee;">
    <img src="<?php echo get_post_meta(get_the_ID(), 'store_logo', true); ?>" alt="<?php the_title(); ?>" style="height:60px;width:60px;margin-right:16px;">
    <div style="flex:1;">
      <h1 style="margin:0;"><?php the_title(); ?></h1>
      <div style="font-size:16px; color:#888; margin-top:4px;">
        Category: <strong><?php echo get_post_meta(get_the_ID(), 'store_category', true); ?></strong>
      </div>
      <div style="margin-top:6px;">
        <span style="background:#ffe082;padding:5px 15px;border-radius:5px;display:inline-block;">
          ★★★★☆ 4.5/5
        </span>
      </div>
    </div>
  </div>
  
  <!-- MAIN CONTENT GRID -->
  <div style="display:flex;flex-wrap:wrap;gap:32px;margin-top:28px;">
    <!-- LEFT: Referral Offer Details -->
    <div style="flex:2;min-width:280px;">
      <h2>Referral Details</h2>
      <div style="background:#f8f9fa; padding:18px 12px 18px 24px; border-radius:8px; margin-bottom:12px;">
        <div><strong>Referral Code:</strong> <?php echo get_post_meta(get_the_ID(), 'referral_code', true); ?></div>
        <div><strong>Referral Link:</strong> <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'referral_link', true)); ?>" target="_blank"><?php echo get_post_meta(get_the_ID(), 'referral_link', true); ?></a></div>
        <div><strong>Reward:</strong> <?php echo get_post_meta(get_the_ID(), 'reward_details', true); ?></div>
        <div><strong>Terms:</strong> <?php echo get_post_meta(get_the_ID(), 'referral_terms', true); ?></div>
      </div>
    </div>
    <!-- RIGHT: User Submitted Codes -->
    <aside style="flex:1;min-width:220px;background:#fafafa;padding:14px 11px;border-radius:8px;">
      <h3 style="margin-top:0;">User Submitted Codes</h3>
      <ul style="padding-left:22px;">
      <?php
      $args = array('post_id' => get_the_ID());
      $comments = get_comments($args);
      foreach($comments as $comment):
        if(get_comment_meta($comment->comment_ID, 'referral_code', true)):
        ?>
        <li>
          <strong><?php echo esc_html(get_comment_meta($comment->comment_ID, 'referral_code', true)); ?></strong>
          <small>by <?php echo esc_html($comment->comment_author); ?></small>
        </li>
        <?php endif;
      endforeach; ?>
      </ul>
    </aside>
  </div>

  <!-- BOTTOM: Referral Submission and Tabs -->
  <div style="margin-top:32px;">
    <!-- Tabs for User Codes/Bigtricks -->
    <ul class="tabs" style="display:flex;gap:32px;list-style:none;margin:0 0 14px 0;padding:0;border-bottom:2px solid #f2f2f2;">
      <li style="padding:6px 14px;cursor:pointer;border-bottom:2px solid #0073aa;color:#0073aa;font-weight:bold;">User Codes</li>
      <li style="padding:6px 14px;cursor:pointer;">Bigtricks Code</li>
    </ul>
    <div class="tab-content" style="background:#f8f9fa;border-radius:8px;padding:16px;">

      <!-- Form: use comment form but relabeled -->
      <h3>Submit Your Referral Code</h3>
      <?php
      comment_form(array(
        'title_reply' => '', 
        'label_submit' => 'Submit Referral Code',
        'comment_notes_before' => '',
        'comment_field' => 
          '<p class="comment-form-comment"><label for="referral_code">Referral Code</label><input id="referral_code" name="referral_code" type="text" style="width:90%;max-width:400px;" /><br/>
          <label for="comment">Note</label><textarea id="comment" name="comment" cols="30" rows="2" style="width:90%;max-width:400px;"></textarea></p>'
      ));
      ?>
      
      <!-- Show submitted referral codes by user -->
      <h4>Latest User Referral Codes</h4>
      <ul style="padding-left:20px;">
        <?php
        foreach($comments as $comment):
          if(get_comment_meta($comment->comment_ID, 'referral_code', true)):
        ?>
          <li>
            <strong><?php echo esc_html(get_comment_meta($comment->comment_ID, 'referral_code', true)); ?></strong>
            (<?php echo esc_html($comment->comment_author); ?>)
          </li>
        <?php endif; endforeach; ?>
      </ul>
      
      <!-- Tab content for Bigtricks code -->
      <div style="display:none;" id="bigtricks-tab">
        <h4>Bigtricks Official Referral Code</h4>
        <div><?php echo get_post_meta(get_the_ID(), 'bigtricks_referral', true); ?></div>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
