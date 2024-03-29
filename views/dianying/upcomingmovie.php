<?php $this->load->view("component/ideapan");//返回顶部与提出意见标签?>
<input type="hidden" name="current_id" id="current_id" value="">
<div class="upcoming_main">
    <div class="guide">
        <a href="/">首页 </a>>
        <span> 即将上映</span>
    </div>
    <?php if (!empty($movieList)): ?>
        <?php $movieListI = 1; ?>
        <?php foreach ($movieList as $movieKey => $movieVal): ?>
            <table class="table table-bordered <?php if ($movieListI == 1): ?>firstOneT<?php endif; ?>">
                <tr>
                    <td class="dy_name" rowspan="3" valign="middle">
                        <div class="dy_name_detail">
                            <?php $idStr = APF::get_instance()->encodeId($movieVal['id']);?>
                            <a href="<?php echo get_url("/detail/index/{$idStr}"); ?>?from=comming_movie_list">
                                <img alt="<?php echo $movieVal['name'];?>" src="<?php echo APF::get_instance()->get_image_url($movieVal['image'],"dy",100);?>">
                            </a>
                        <span class="">
                            <?php echo $movieVal['name'];?>
                        </span>
                        </div>
                    </td>
                    <td>
                        <strong>导演：</strong><?php echo trim($movieVal['daoyan']);?>
                        <span>|</span>
                        <strong>主演：</strong><?php $zhuyao = preg_split("/;+|；+/", $movieVal['zhuyan']);echo trim(implode("、", $zhuyao));?>
                        <span>|</span>
                        <strong>年份：</strong><?php echo substr($movieVal['nianfen'],0,4);?>年
                        <span>|</span>
                        <?php if (!empty($movieVal['shichang'])):?>
                            <strong>时长：</strong><?php echo $movieVal['shichang'];?>分
                            <span>|</span>
                        <?php endif;?>
                        <strong>地区：</strong><?php echo $moviePlace[$movieVal['diqu']];?>
                        <span>|</span>
                        <strong>类型：</strong><?php echo ($movieType[$movieVal['type']] == "其他")? $movieType[$movieVal['type']] : $movieType[$movieVal['type']] . "片";?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php if (!empty($movieVal['time1'])): ?>
                            <strong>内陆上映时间：</strong><?php echo date("Y-m-d", $movieVal['time1']); ?>
                        <?php endif;?>
                        <?php if (!empty($movieVal['time2'])): ?>
                            <span>|</span>
                            <strong>港台上映时间：</strong><?php echo date("Y-m-d", $movieVal['time2']); ?>
                        <?php endif;?>
                        <?php if (!empty($movieVal['time3'])): ?>
                            <span>|</span>
                            <strong>欧美上映时间：</strong><?php echo date("Y-m-d", $movieVal['time3']); ?>
                        <?php endif;?>
                        <?php if (!empty($userNoticeInfos[$movieVal['id']])): ?>
                            <span class="btn dy_notic_btn">
                            <i class="icon-check icon-white"></i>
                            已订阅观看通知
                        </span>
                        <?php else: ?>
                            <span class="btn dy_notic" val="<?php echo $movieVal['id']; ?>">
                            <i class="icon-volume-up"></i>
                            订阅观看通知
                        </span>
                        <?php endif;?>
                    </td>
                </tr>
                <tr>
                    <td><strong>简介：</strong><?php echo trim(strip_tags($movieVal['jieshao']));?></td>
                </tr>
            </table>
            <?php $movieListI++; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="clear"></div>
</div>
<script type="text/javascript">
    (function($){
        $(document).ready(function(){
            $("table.table tr td span.btn").each(function(){
                $(this).bind("click",function(event){
                    <?php if (empty($userId)):?>
                        var id = $(this).attr("val");
                        $("#current_id").val(id);
                        logPanInit.showLoginPan("init.loginCallBack");
                        event.stopPropagation();
                    <?php else:?>
                        init.insertNoticeDo($(this),event);
                    <?php endif;?>
                });
            });
            $("div.container table.table-bordered").each(function(){
               $(this).bind("mouseover",function(){
                   $(this).addClass("table_over");
               });
               $(this).bind("mouseleave",function(){
                    $(this).removeClass("table_over");
               });
               $(this).bind("click",function(){
                    var url = $($(this).find("a").get(0)).attr("href");
                   window.location.href = url;
               });
            });
        });
    })(jQuery);
</script>
