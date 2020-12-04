<?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true))->to($tags); ?>
<?php if ($tags->have()) : ?>
    <div class="j-label">
        <ul>
            <?php while ($tags->next()) : ?>
                <li>
                    <a href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="j-file">
    <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
    $year = 0;
    $mon = 0;
    $i = 0;
    $j = 0;
    $output = '';
    while ($archives->next()) :
        $year_tmp = date('Y', $archives->created);
        $mon_tmp = date('m', $archives->created);
        if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></div>';
        if ($year != $year_tmp && $year > 0) $output .= '</ul></div>';
        if ($mon != $mon_tmp) {
            $mon = $mon_tmp;
            $output .= '<div class="item"><span class="panel">' . $year_tmp . ' 年 ' . $mon . ' 月<svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M21.6 772.8c28.8 28.8 74.4 28.8 103.2 0L512 385.6 899.2 772.8c28.8 28.8 74.4 28.8 103.2 0 28.8-28.8 28.8-74.4 0-103.2l-387.2-387.2-77.6-77.6c-14.4-14.4-37.6-14.4-51.2 0l-77.6 77.6-387.2 387.2c-28.8 28.8-28.8 75.2 0 103.2z"></path></svg></span><ul class="panel-body">';
        }
        $output .= '<li><a href="' . $archives->permalink . '">' . date('m/d：', $archives->created) . $archives->title . '</a>';
        $output .= '</li>';
    endwhile;
    $output .= '</ul></div>';
    echo $output;
    ?>
</div>