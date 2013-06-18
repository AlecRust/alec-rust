<?php
/**
 * Home page Twitter feed module
 *
 * @package WordPress
 * @subpackage Alec_Rust
 */
?>

<section class="module module-tweets">
    <h1><a href="https://twitter.com/AlecRust">Recent tweets</a></h1>
    <?php
    $tweets = getTweets(3); // number (up to 20) of tweets
    if (is_array($tweets)) {
    ?>
    <ul>
        <?php foreach ($tweets as $tweet) { ?>
        <li>
            <?php

                if ($tweet['text']) {
                    $the_tweet = $tweet['text'];
                    /**
                     * Twitter Developer Display Requirements
                     * https://dev.twitter.com/terms/display-requirements
                     */

                    // User_mentions link to the mentioned user's profile
                    if (is_array($tweet['entities']['user_mentions'])) {
                        foreach ($tweet['entities']['user_mentions'] as $key => $user_mention) {
                            $the_tweet = preg_replace(
                                '/@'.$user_mention['screen_name'].'/i',
                                '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
                                $the_tweet);
                        }
                    }

                    // Hashtags link to a twitter.com search with the hashtag as the query
                    if (is_array($tweet['entities']['hashtags'])) {
                        foreach ($tweet['entities']['hashtags'] as $key => $hashtag) {
                            $the_tweet = preg_replace(
                                '/#'.$hashtag['text'].'/i',
                                '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
                                $the_tweet);
                        }
                    }

                    // Links in Tweet text are displayed using the display_url field in the URL entities API response, and link to the original t.co url field
                    if (is_array($tweet['entities']['urls'])) {
                        foreach ($tweet['entities']['urls'] as $key => $link) {
                            $the_tweet = preg_replace(
                                '`'.$link['url'].'`',
                                '<a href="'.$link['url'].'">'.$link['url'].'</a>',
                                $the_tweet);
                        }
                    }

                    echo $the_tweet;

                    // Timestamp/permalink
                    echo '
                        <a href="https://twitter.com/AlecRust/status/'.$tweet['id_str'].'">
                            <time datetime="'.date('Y-m-d\TH:i:s',strtotime($tweet['created_at']. '+ 1 hours')).'" class="timestamp">
                                '.date('l d M H:i',strtotime($tweet['created_at']. '+ 1 hours')).'
                            </time>
                        </a>';
                }
                else {
                    echo '<a href="https://twitter.com/AlecRust">View my Twitter profile</a>';
                }

            ?>
        </li>
    <?php
        }
    }
    ?>
    </ul>
    <p class="view-more"><a href="https://twitter.com/AlecRust">View my Twitter profile</a></p>
</section>
