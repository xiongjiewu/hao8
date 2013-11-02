<?php $this->load->view("component/ideapan");//返回顶部与提出意见标签?>
<div class="search_main">
    <div class="guide">
        <a href="/">首页 </a>>
        <span> 搜'<?php echo $searchW;?>'相关的影片</span>
    </div>
    <!-- 人物信息展示 start -->
    <?php if (!empty($peopleInfo)):?>
        <div class="peopel_info_list" title="点击了解详情">
            <?php $url = APF::get_instance()->get_real_url("/people",$peopleInfo['id'],array("from" => "search_people"));?>
            <div class="peopel_img">
                <a class="" href="<?php echo $url;?>">
                    <img src="<?php echo APF::get_instance()->get_image_url($peopleInfo['photo'],"dy",300);?>">
                </a>
            </div>
            <div class="people_detail_info">
                <dl>
                    <dt><a href="<?php echo $url;?>"><?php echo $peopleInfo['name'];?></a></dt>
                    <dd>生日：<?php if (empty($peopleInfo['birthday'])):?>暂无<?php else:?>
                            <?php if (strlen($peopleInfo['birthday']) == 4):?>
                                <?php echo $peopleInfo['birthday'] . "年";?>
                            <?php elseif (strlen($peopleInfo['birthday']) == 5):?>
                                <?php echo substr($peopleInfo['birthday'],0,4) . "年" . substr($peopleInfo['birthday'],4,1) . "月";?>
                            <?php elseif (strlen($peopleInfo['birthday']) == 6):?>
                                <?php echo substr($peopleInfo['birthday'],0,4) . "年" . substr($peopleInfo['birthday'],4,1) . "月" . substr($peopleInfo['birthday'],5,1) . "日";?>
                            <?php elseif (strlen($peopleInfo['birthday']) == 7):?>
                                <?php echo substr($peopleInfo['birthday'],0,4) . "年" . substr($peopleInfo['birthday'],4,1) . "月" . substr($peopleInfo['birthday'],5,2) . "日";?>
                            <?php else:?>
                                <?php echo date("Y年m月d日",strtotime($peopleInfo['birthday']));?>
                            <?php endif;?>
                        <?php endif;?>
                    </dd>
                    <dd>星座：<?php echo empty($peopleInfo['constellatory']) ? "暂无" : $xingzuoInfo[$peopleInfo['constellatory']];?></dd>
                    <dd>身高：<?php echo (!empty($peopleInfo['height']) && $peopleInfo['height'] > 0) ? round($peopleInfo['height']) . "cm" : "暂无";?></dd>
                    <dd><?php $peopleInfo['birthplace'] = trim($peopleInfo['birthplace']);?>
                        出生地：<?php echo empty($peopleInfo['birthplace']) ? "暂无" : $peopleInfo['birthplace'];?></dd>
                    <dd>
                        简介：<?php echo empty($peopleInfo['jieshao']) ? "暂无" : APF::get_instance()->splitStr($peopleInfo['jieshao'],120,"...");?>
                        <a class="" href="<?php echo APF::get_instance()->get_real_url("/people",$peopleInfo['id']);?>">[了解详情]</a>
                    </dd>
                    <?php if (!empty($searchMovieInfo)):?>
                        <dd>
                            <div class="dy_list">
                                <ul>
                                    <?php $sMovieInfo = array_slice($searchMovieInfo,0,7);?>
                                    <?php foreach($sMovieInfo as $searchInfo):?>
                                        <?php $url = APF::get_instance()->get_real_url("/detail",$searchInfo['id']);?>
                                        <li>
                                            <a href="<?php echo $url;?>">
                                                <img src="<?php echo APF::get_instance()->get_image_url($searchInfo['image'],"dy",100);?>">
                                            </a>
                                            <span class="name"><?php echo $searchInfo['name'];?></span>
                                        </li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </dd>
                    <?php endif;?>
                </dl>
            </div>
        </div>
    <?php endif;?>
    <!-- 人物信息展示 end -->
    <?php if (empty($peopleInfo) || (!empty($searchMovieInfo) && !empty($peopleInfo))):?>
    <div class="search_left">
        <div class="type_list top">
            <div class="search_left_top">
                <h1>我要筛选</h1>
            </div>
            <?php $typeCount = count($movieSortType);?>
            <?php $typeI = 1;?>
            <?php foreach ($movieSortType as $typeKey => $typeVal):?>
                <ul <?php if($typeI == $typeCount):?>class="last_one"<?php endif;?>>
                    <li class="title_text"><?php echo $typeVal['type'];?></li>
                    <?php if ($typeKey == 0 ):?>
                        <li <?php if ($type == "all"):?>class="current"<?php endif;?>>
                            <a href="/search/index/all/<?php echo $year;?>/<?php echo $diqu;?>?key=<?php echo $searchW;?>">全部</a>
                        </li>
                    <?php elseif($typeKey == 1):?>
                        <li <?php if ($year == "all"):?>class="current"<?php endif;?>>
                            <a href="/search/index/<?php echo $type;?>/all/<?php echo $diqu;?>?key=<?php echo $searchW;?>">全部</a>
                        </li>
                    <?php else:?>
                        <li <?php if ($diqu == "all"):?>class="current"<?php endif;?>>
                            <a href="/search/index/<?php echo $type;?>/<?php echo $year;?>/all?key=<?php echo $searchW;?>">全部</a>
                        </li>
                    <?php endif;?>
                    <?php foreach ($typeVal['info'] as $typeValKey => $typeInfoVal): ?>
                        <?php if ($typeKey == 0 ):?>
                            <li <?php if ($type == $typeValKey):?>class="current"<?php endif;?>>
                                <a href="/search/index/<?php echo $typeValKey;?>/<?php echo $year;?>/<?php echo $diqu;?>?key=<?php echo $searchW;?>"><?php echo $typeInfoVal;?></a>
                            </li>
                        <?php elseif($typeKey == 1):?>
                            <li <?php if ($year == $typeValKey):?>class="current"<?php endif;?>>
                                <a href="/search/index/<?php echo $type;?>/<?php echo $typeValKey;?>/<?php echo $diqu;?>?key=<?php echo $searchW;?>"><?php echo $typeInfoVal;?></a>
                            </li>
                        <?php else:?>
                            <li <?php if ($diqu == $typeValKey):?>class="current"<?php endif;?>>
                                <a href="/search/index/<?php echo $type;?>/<?php echo $year;?>/<?php echo $typeValKey;?>?key=<?php echo $searchW;?>"><?php echo $typeInfoVal;?></a>
                            </li>
                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
                <?php $typeI++;?>
            <?php endforeach;?>
            <div class="search_left_bottom"></div>
        </div>
    </div>
    <?php endif;?>
    <div class="search_dy_info">
        <ul>
            <?php if (!empty($topicInfo)):?>
                <?php $i = 0;?>
                <?php foreach($topicInfo as $topicVal):?>
                    <?php $url = APF::get_instance()->get_real_url("/series/info/",$topicVal['id'],array(),true);?>
                    <li <?php if ($i == 0):?>class="first_one"<?php endif;?> title="点击查看详情">
                        <div class="search_dy_img">
                            <a href="<?php echo $url;?>">
                                <img alt="<?php echo $topicVal['name'];?>" src="<?php echo APF::get_instance()->get_image_url($topicVal['mImg'],"dy",200);?>">
                            </a>
                        </div>
                        <div class="search_dy_detail">
                            <p class="title">
                                <a href="<?php echo $url;?>">
                                    <em><?php echo $topicVal['name'];?></em><b><?php if ($topicVal['topicType'] == 2):?>[系列]<?php else:?>[专题]<?php endif;?></b>
                                </a>
                                <span class="nianfen">共<em><?php echo $topicVal['movieCount'];?></em>部</span>
                            </p>
                            <p class="other">
                                <span>点击：</span><em><?php echo $topicVal['clickNum'];?>次</em>
                            </p>
                            <p class="other">
                                <span>类型：</span><?php echo $movieType[$topicVal['type']];?>
                            </p>
                            <p class="other">
                                <span>地区：</span><?php echo $moviePlace[$topicVal['diqu']];?>
                            </p>
                            <p class="jianjie">
                                <span>简介：</span><?php echo APF::get_instance()->splitStr(strip_tags($topicVal['bTitle']),200);?>
                            </p>
                        </div>
                    </li>
                    <?php $i++;?>
                <?php endforeach;?>
            <?php endif;?>
            <?php if (!empty($searchMovieInfo)):?>
                <?php $i = 0;?>
                <?php foreach($searchMovieInfo as $movieVal):?>
                    <?php $url = APF::get_instance()->get_real_url("detail",$movieVal['id'],array("from" => "search"));?>
                    <?php $zhuyaoArr = explode("、",$movieVal['zhuyan']);?>
                    <?php $daoyanArr = explode("、",$movieVal['daoyan']);?>
                    <?php if (!empty($movieVal['time1'])){$movieVal['nianfen'] = date("Y",$movieVal['time1']);}?>
                    <li <?php if ($i == 0):?>class="first_one"<?php endif;?> title="点击查看详情">
                        <div class="search_dy_img">
                            <a href="<?php echo $url;?>">
                                <img alt="<?php echo $movieVal['name'];?>" src="<?php echo APF::get_instance()->get_image_url($movieVal['image'],"dy",200);?>">
                            </a>
                        </div>
                        <div class="search_dy_detail">
                            <p class="title">
                                <a href="<?php echo $url;?>">
                                    <?php echo $movieVal['s_name'];?>
                                </a>
                                <?php if (!empty($movieVal['nianfen'])):?>
                                <span class="nianfen">年份：<?php echo $movieVal['nianfen'];?></span>
                                <?php endif;?>
                                <?php if ($movieVal['exist_down'] == 1):?>
                                    <span class="nianfen down_link">
                                        [有下载链接]
                                    </span>
                                <?php elseif ($movieVal['exist_watch'] == 1):?>
                                    <span class="nianfen down_link">
                                        [有观看链接]
                                    </span>
                                <?php endif;?>
                            </p>
                            <p class="zhuyan">
                                <span>主演：</span>
                                <?php if (empty($zhuyaoArr)):?>
                                    暂无
                                <?php else:?>
                                    <?php foreach($zhuyaoArr as $zhuyanVal):?>
                                        <a href="<?php echo APF::get_instance()->get_real_url("/jump","",array("type" => 1,"key" => strip_tags($zhuyanVal)));?>"><?php echo $zhuyanVal?></a>&nbsp;&nbsp;
                                    <?php endforeach;?>
                                <?php endif;?>
                            </p>
                            <p class="other">
                                <span>导演：</span>
                                <?php if (empty($daoyanArr)):?>
                                    暂无
                                <?php else:?>
                                    <?php foreach($daoyanArr as $daoyanVal):?>
                                        <a href="<?php echo APF::get_instance()->get_real_url("/jump","",array("type" => 1,"key" => strip_tags($daoyanVal)));?>"><?php echo $daoyanVal;?></a>&nbsp;&nbsp;
                                    <?php endforeach;?>
                                <?php endif;?>
                            </p>
                            <p class="other">
                                <span>类型：</span><?php echo $movieType[$movieVal['type']];?>
                            </p>
                            <p class="jianjie">
                                <span>简介：</span><?php echo strip_tags($movieVal['jieshao']);?>
                            </p>
                        </div>
                    </li>
                    <?php $i++;?>
                <?php endforeach;?>
                <?php elseif (empty($peopleInfo) && empty($topicInfo)):?>
                    <li class="no_data">
                        <div class="error_imga">
                            <img src="/images/error.png">
                        </div>
                        <div class="error_text">
                            糟糕，您搜索的信息暂无，您可以尝试换个方式搜索！
                        </div>
                    </li>
            <?php endif;?>
        </ul>
    </div>
    <div class="clear"></div>
</div>