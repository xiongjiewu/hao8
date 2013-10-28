<div class="user_main">
<div class="row">
    <?php $this->load->view("component/usercenterleft",array("userInfo" =>$userInfo,"index"=>($type =="want") ?3 : 5));?>
    <div class="right_container">
        <div class="main-tab">
            <?php if ($type =="want"):?>
                <a href="<?php echo get_url("/usercenter/feedback/want/")?>">我的反馈</a>
                <a class="tab-focus" href="javascript:void(0);">反馈我想看</a>
            <?php else:?>
                <a  href="<?php echo get_url("/usercenter/feedback/suggest/")?>">投诉与建议</a>
                <a class="tab-focus" href="javascript:void(0);">反馈投诉与建议</a>
            <?php endif;?>
        </div>
        <div id="usermain">
            <div class="show mod-dist-r">
                <div class="modbox2" style="border: none;">
                    <form id="edit_feedback" name="edit_feedback" action="<?php echo get_url("/usercenter/createfeedbacksubmit/");?>" method="post">
                        <table class="edit_xheditor_table">
                            <tr>
                                <td>
                                    <code>*</code>标题：
                                </td>
                                <td>
                                    <input type="text" name="title" id="title" value="">
                                </td>
                                <td class="error_text">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <code>*</code>内容：
                                </td>
                                <td class="edit_xheditor">
                                    <input type="hidden" name="type" id="type" value="<?php echo $type;?>">
                                    <textarea class="xheditor" name="content" id="content"></textarea>
                                    <p></p>
                                    <input type="submit" id="create_post_button" class="btn btn-primary" value="提交反馈"><span
                                        style="color: #aaa">（ctrl+enter快捷提交）</span>
                                </td>
                                <td class="error_text">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>