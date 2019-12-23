<?php
include "../include/lib.php";

if ($_POST) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $pw = $_POST['pw'];
    $auth = $_POST['auth'];
    $phone = $_POST['phone'];
    $pos = $_POST['pos'];

    $error = '';
    // 형식 검증
    if (!ctype_alpha($id) || strlen($id) < 4 || strlen($id) > 12) $error .= '아이디[영문 4~12자 이내]\n';
    if (!preg_match('/^[가-힣]$/', $name) || strlen($name) < 6 || strlen($name) > 12) $error .= '성명[한글 2~4자 이내]\n';
    if (!ctype_alnum($pw) || strlen($pw) < 4 || strlen($pw) > 8) $error .= '비밀번호[영문, 숫자 조합 4~8자 이내]\n';
    if ($auth === '') $error .= '회원구분[필수 입력]\n';
    if (!preg_match("/^[0-9]{4}-[0-9]{4}-[0-9]{4}$/", $phone)) $error .= '전화번호[0000-0000-0000 형식]\n';
    if ($pos === '') $error .= '위치 정보[필수 입력]\n';


    $member = $pdo->query("select * from member where id = '$id'")->fetch(2);

    if ($error !== '') {
        alert($error . '* 위의 형식에 따라 작성해주세요! *');
    } else if ($member) {
        alert('이미 사용중인 아이디입니다!');
    } else {
        $pdo->query("insert into member(id,name,pw,auth,phone,pos) values('$id','$name','$pw','$auth','$phone','$pos')");
        alert('회원가입이 완료되었습니다.');
        move('/page/login.php');
    }

    back();
}
?>

/*   
 *   
 * 같은 값이 있는 열을 병합함  
 *   
 * 사용법 : $('#테이블 ID').rowspan(0);  
 *   
 */       
$.fn.rowspan = function(colIdx, isStats) {         
    return this.each(function(){        
        var that;       
        $('tr', this).each(function(row) {        
            $('td',this).eq(colIdx).filter(':visible').each(function(col) {  
                  
                if ($(this).html() == $(that).html()  
                    && (!isStats   
                            || isStats && $(this).prev().html() == $(that).prev().html()  
                            )  
                    ) {              
                    rowspan = $(that).attr("rowspan") || 1;  
                    rowspan = Number(rowspan)+1;  
  
                    $(that).attr("rowspan",rowspan);  
                      
                    // do your action for the colspan cell here              
                    $(this).hide();  
                      
                    //$(this).remove();   
                    // do your action for the old cell here  
                      
                } else {              
                    that = this;           
                }            
                  
                // set the that if not already set  
                that = (that == null) ? this : that;        
            });       
        });      
    });    
};