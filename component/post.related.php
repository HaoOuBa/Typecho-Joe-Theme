<?php $this->related(4)->to($relatedPosts); ?>
<?php if ($relatedPosts->have()) : ?>
    <div class="related">
        <div class="title">相关推荐</div>
        <ul>
            <?php while ($relatedPosts->next()) : ?>
                <li>
                    <a href="<?php $relatedPosts->permalink(); ?>">
                        <img class="lazyload" src="<?php echo GetLazyLoad() ?>" data-original="<?php GetRandomThumbnail($relatedPosts); ?>">
                        <span><?php $relatedPosts->title(); ?></span>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif; ?>