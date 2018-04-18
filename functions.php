<?php

function themeslug_newsapi_data($country,$category,$t) {

$data = get_transient( 'newsapi_' . sanitize_title($category).sanitize_title($country).sanitize_title($t) );

        if( empty( $data ) ) {
            $request = wp_remote_get( add_query_arg( array(
                    'country' => $country,
                    'category' => $category,
                    'apiKey' => 'API_KEY_HERE' // do not forget to set your API key here
            ), 'https://newsapi.org/v2/top-headlines' ) );
            if( is_wp_error( $request ) ) {
                return false; 
            }
            $body = wp_remote_retrieve_body( $request );
            $data = json_decode( $body );
            if( ! empty( $data ) ) {
             set_transient( 'newsapi_' . sanitize_title($category).sanitize_title($country).sanitize_title($t), $data, 3600);
            }
         }

        if( ! empty( $data ) ) {
            
            if ( $t == 1) {

                foreach ($data->articles as $one_news) {

                    if ($one_news->urlToImage) { ?>
                
                        <div class="space-single-news-item relative">
                            <div class="space-single-news-img">
                                <a href="<?php echo esc_url($one_news->url); ?>" title="<?php echo esc_attr($one_news->title); ?>" target="_blank"><img src="<?php echo esc_url($one_news->urlToImage); ?>" alt="<?php echo esc_attr($one_news->title); ?>"></a>
                            </div>
                        </div>

                <?php }

                }

            } else if ( $t == 2) {

                foreach ($data->articles as $one_news){ ?>

                    <div class="space-single-news relative">
                        <div class="space-single-news-ins relative">
                            <?php if ($one_news->urlToImage) { ?>
                            <div class="space-single-news-img">
                                <a href="<?php echo esc_url($one_news->url); ?>" title="<?php echo esc_attr($one_news->title); ?>" target="_blank"><img src="<?php echo esc_url($one_news->urlToImage); ?>" alt="<?php echo esc_attr($one_news->title); ?>"></a>
                            </div>
                            <?php } ?>
                            <span class="space-single-news-title"><?php echo esc_html($one_news->title); ?></span>
                            <span class="space-single-news-source"><?php echo esc_html($one_news->source->name); ?></span>
                            <p>
                                <?php echo esc_html($one_news->description); ?>
                            </p>
                            <div class="space-single-news-meta relative">
                                <?php echo esc_html($one_news->publishedAt); ?>
                                <a href="<?php echo esc_url($one_news->url); ?>" title="<?php echo esc_attr( 'Read more', 'themeslug' ); ?>" target="_blank"><?php echo esc_html( 'Read more', 'themeslug' ); ?></a>
                            </div>
                        </div>
                    </div>

                <?php }
            } 
        }
}
