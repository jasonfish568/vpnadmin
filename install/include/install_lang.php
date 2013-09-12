<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install_lang.php 32641 2013-02-27 08:39:58Z monkey $
 */

if(!defined('IN_COMSENZ')) {
	exit('Access Denied');
}

define('UC_VERNAME', '���İ�');
$lang = array(
	'SC_GBK' => '�������İ�',
	'TC_BIG5' => '�������İ�',
	'SC_UTF8' => '�������� UTF8 ��',
	'TC_UTF8' => '�������� UTF8 ��',
	'EN_ISO' => 'ENGLISH ISO8859',
	'EN_UTF8' => 'ENGLIST UTF-8',

	'title_install' => SOFT_NAME.' ��װ��',
	'agreement_yes' => '��ͬ��',
	'agreement_no' => '�Ҳ�ͬ��',
	'notset' => '������',

	'message_title' => '��ʾ��Ϣ',
	'error_message' => '������Ϣ',
	'message_return' => '����',
	'return' => '����',
	'install_wizard' => '��װ��',
	'config_nonexistence' => '�����ļ�������',
	'nodir' => 'Ŀ¼������',
	'redirect' => '��������Զ���תҳ�棬�����˹���Ԥ��<br>���ǵ����������û���Զ���תʱ����������',
	'auto_redirect' => '��������Զ���תҳ�棬�����˹���Ԥ',
	'database_errno_2003' => '�޷��������ݿ⣬�������ݿ��Ƿ����������ݿ��������ַ�Ƿ���ȷ',
	'database_errno_1044' => '�޷������µ����ݿ⣬�������ݿ�������д�Ƿ���ȷ',
	'database_errno_1045' => '�޷��������ݿ⣬�������ݿ��û������������Ƿ���ȷ',
	'database_errno_1064' => 'SQL �﷨����',

	'dbpriv_createtable' => 'û��CREATE TABLEȨ�ޣ��޷�������װ',
	'dbpriv_insert' => 'û��INSERTȨ�ޣ��޷�������װ',
	'dbpriv_select' => 'û��SELECTȨ�ޣ��޷�������װ',
	'dbpriv_update' => 'û��UPDATEȨ�ޣ��޷�������װ',
	'dbpriv_delete' => 'û��DELETEȨ�ޣ��޷�������װ',
	'dbpriv_droptable' => 'û��DROP TABLEȨ�ޣ��޷���װ',

	'db_not_null' => '���ݿ����Ѿ���װ�� UCenter, ������װ�����ԭ�����ݡ�',
	'db_drop_table_confirm' => '������װ�����ȫ��ԭ�����ݣ���ȷ��Ҫ������?',

	'writeable' => '��д',
	'unwriteable' => '����д',
	'old_step' => '��һ��',
	'new_step' => '��һ��',

	'database_errno_2003' => '�޷��������ݿ⣬�������ݿ��Ƿ����������ݿ��������ַ�Ƿ���ȷ',
	'database_errno_1044' => '�޷������µ����ݿ⣬�������ݿ�������д�Ƿ���ȷ',
	'database_errno_1045' => '�޷��������ݿ⣬�������ݿ��û������������Ƿ���ȷ',
	'database_connect_error' => '���ݿ����Ӵ���',

	'step_title_1' => '��鰲װ����',
	'step_title_2' => '�������л���',
	'step_title_3' => '�������ݿ�',
	'step_title_4' => '��װ',
	'step_env_check_title' => '��ʼ��װ',
	'step_env_check_desc' => '�����Լ��ļ�Ŀ¼Ȩ�޼��',
	'step_db_init_title' => '��װ���ݿ�',
	'step_db_init_desc' => '����ִ�����ݿⰲװ',

	'step1_file' => 'Ŀ¼�ļ�',
	'step1_need_status' => '����״̬',
	'step1_status' => '��ǰ״̬',
	'not_continue' => '�뽫���Ϻ�沿����������',

	'tips_dbinfo' => '��д���ݿ���Ϣ',
	'tips_dbinfo_comment' => '',
	'tips_admininfo' => '��д����Ա��Ϣ',
	'step_ext_info_title' => '��װ�ɹ���',
	'step_ext_info_comment' => '��������¼',

	'ext_info_succ' => '��װ�ɹ���',
	'install_submit' => '�ύ',
	'install_locked' => '��װ�������Ѿ���װ���ˣ������ȷ��Ҫ���°�װ���뵽��������ɾ��<br /> '.str_replace(ROOT_PATH, '', $lockfile),
	'error_quit_msg' => '���������������⣬��װ�ſ��Լ���',

	'step_app_reg_title' => '�������л���',
	'step_app_reg_desc' => '�������������Լ����� UCenter',
	'tips_ucenter' => '����д UCenter �����Ϣ',


	'advice_mysql_connect' => '���� mysql ģ���Ƿ���ȷ����',
	'advice_gethostbyname' => '�Ƿ� PHP �����н�ֹ�� gethostbyname ����������ϵ�ռ��̣�ȷ�������˴����',
	'advice_file_get_contents' => '�ú�����Ҫ php.ini �� allow_url_fopen ѡ���������ϵ�ռ��̣�ȷ�������˴����',
	'advice_xml_parser_create' => '�ú�����Ҫ PHP ֧�� XML������ϵ�ռ��̣�ȷ�������˴����',
	'advice_fsockopen' => '�ú�����Ҫ php.ini �� allow_url_fopen ѡ���������ϵ�ռ��̣�ȷ�������˴����',
	'advice_pfsockopen' => '�ú�����Ҫ php.ini �� allow_url_fopen ѡ���������ϵ�ռ��̣�ȷ�������˴����',
	'advice_stream_socket_client' => '�Ƿ� PHP �����н�ֹ�� stream_socket_client ����',
	'advice_curl_init' => '�Ƿ� PHP �����н�ֹ�� curl_init ����',




	'tips_siteinfo' => '����дվ����Ϣ',
	'sitename' => 'վ������',
	'siteurl' => 'վ�� URL',

	'forceinstall' => 'ǿ�ư�װ',
	'dbinfo_forceinstall_invalid' => '��ǰ���ݿ⵱���Ѿ�����ͬ����ǰ׺�����ݱ��������޸ġ�����ǰ׺��������ɾ���ɵ����ݣ�����ѡ��ǿ�ư�װ��ǿ�ư�װ��ɾ�������ݣ����޷��ָ�',

	'click_to_back' => '���������һ��',
	'adminemail' => 'ϵͳ���� Email',
	'adminemail_comment' => '���ڷ��ͳ�����󱨸�',
	'dbhost_comment' => '���ݿ��������ַ, һ��Ϊ localhost',
	'tablepre_comment' => 'ͬһ���ݿ����ж������ϵͳʱ�����޸�ǰ׺',
	'forceinstall_check_label' => '��Ҫɾ�����ݣ�ǿ�ư�װ !!!',




	'siteinfo_siteurl_invalid' => 'վ��URLΪ�գ����߸�ʽ��������',
	'siteinfo_sitename_invalid' => 'վ������Ϊ�գ����߸�ʽ��������',
	'dbinfo_dbhost_invalid' => '���ݿ������Ϊ�գ����߸�ʽ��������',
	'dbinfo_dbname_invalid' => '���ݿ���Ϊ�գ����߸�ʽ��������',
	'dbinfo_dbuser_invalid' => '���ݿ��û���Ϊ�գ����߸�ʽ��������',
	'dbinfo_dbpw_invalid' => '���ݿ�����Ϊ�գ����߸�ʽ��������',
	'dbinfo_adminemail_invalid' => 'ϵͳ����Ϊ�գ����߸�ʽ��������',
	'dbinfo_tablepre_invalid' => '���ݱ�ǰ׺Ϊ�գ����߸�ʽ��������',
	'admininfo_username_invalid' => '����Ա�û���Ϊ�գ����߸�ʽ��������',
	'admininfo_email_invalid' => '����ԱEmailΪ�գ����߸�ʽ��������',
	'admininfo_password_invalid' => '����Ա����Ϊ�գ�����д',
	'admininfo_password2_invalid' => '�������벻һ�£�����',

	'install_dzfull' => '<br><label><input type="radio"'.(getgpc('install_ucenter') != 'no' ? ' checked="checked"' : '').' name="install_ucenter" value="yes" onclick="if(this.checked)$(\'form_items_2\').style.display=\'none\';" /> ȫ�°�װ VPN ADMIN 1.0</label>',


	'username' => '����Ա�˺�',
	'email' => '����Ա Email',
	'password' => '����Ա����',
	'password_comment' => '����Ա���벻��Ϊ��',
	'password2' => '�ظ�����',

	'admininfo_invalid' => '����Ա��Ϣ���������������Ա�˺ţ����룬����',
	'dbname_invalid' => '���ݿ���Ϊ�գ�����д���ݿ�����',
	'tablepre_invalid' => '���ݱ�ǰ׺Ϊ�գ����߸�ʽ��������',
	'admin_username_invalid' => '�Ƿ��û������û������Ȳ�Ӧ������ 15 ��Ӣ���ַ����Ҳ��ܰ��������ַ���һ�������ģ���ĸ��������',
	'admin_password_invalid' => '��������治һ�£�����������',
	'admin_email_invalid' => 'Email ��ַ���󣬴��ʼ���ַ�Ѿ���ʹ�û��߸�ʽ��Ч�������Ϊ������ַ',
	'admin_invalid' => '������Ϣ����Ա��Ϣû����д����������ϸ��дÿ����Ŀ',
	'admin_exist_password_error' => '���û��Ѿ����ڣ������Ҫ���ô��û�Ϊ��̳�Ĺ���Ա������ȷ������û������룬�����������̳����Ա������',

	'tagtemplates_subject' => '����',
	'tagtemplates_uid' => '�û� ID',
	'tagtemplates_username' => '������',
	'tagtemplates_dateline' => '����',
	'tagtemplates_url' => '�����ַ',

	'config_unwriteable' => '��װ���޷�д�������ļ�, ������ config.inc.php ��������Ϊ��д״̬(777)',

	'install_in_processed' => '���ڰ�װ...',
	'install_succeed' => '��װ�ɹ����������',



	'license' => '<div class="license"><h1>���İ���ȨЭ�� �����������û�</h1>

<p>��Ȩ���� (c) 2013��VPN.EUCLAN.COM</p>



<p>�������꣩</p>

<p align="right">EU CLAN</p>

</div>',

	'uc_installed' => '���Ѿ���װ�� UCenter�������Ҫ���°�װ����ɾ�� data/install.lock �ļ�',
	'i_agree' => '������ϸ�Ķ�����ͬ�����������е���������',
	'supportted' => '֧��',
	'unsupportted' => '��֧��',
	'max_size' => '֧��/���ߴ�',
	'project' => '��Ŀ',
	'ucenter_required' => 'Discuz! ��������',
	'ucenter_best' => 'Discuz! ���',
	'curr_server' => '��ǰ������',
	'env_check' => '�������',
	'os' => '����ϵͳ',
	'php' => 'PHP �汾',
	'attachmentupload' => '�����ϴ�',
	'unlimit' => '������',
	'version' => '�汾',
	'gdversion' => 'GD ��',
	'allow' => '���� ',
	'unix' => '��Unix',
	'diskspace' => '���̿ռ�',
	'priv_check' => 'Ŀ¼���ļ�Ȩ�޼��',
	'func_depend' => '���������Լ��',
	'func_name' => '��������',
	'check_result' => '�����',
	'suggestion' => '����',
	'advice_mysql' => '���� mysql ģ���Ƿ���ȷ����',
	'advice_fopen' => '�ú�����Ҫ php.ini �� allow_url_fopen ѡ���������ϵ�ռ��̣�ȷ�������˴����',
	'advice_file_get_contents' => '�ú�����Ҫ php.ini �� allow_url_fopen ѡ���������ϵ�ռ��̣�ȷ�������˴����',
	'advice_xml' => '�ú�����Ҫ PHP ֧�� XML������ϵ�ռ��̣�ȷ�������˴����',
	'none' => '��',

	'dbhost' => '���ݿ������',
	'dbuser' => '���ݿ��û���',
	'dbpw' => '���ݿ�����',
	'dbname' => '���ݿ���',
	'tablepre' => '���ݱ�ǰ׺',

	'ucfounderpw' => '��ʼ������',
	'ucfounderpw2' => '�ظ���ʼ������',

	'init_log' => '��ʼ����¼',
	'clear_dir' => '���Ŀ¼',
	'select_db' => 'ѡ�����ݿ�',
	'create_table' => '�������ݱ�',
	'succeed' => '�ɹ� ',

	'install_data' => '���ڰ�װ����',
	'install_test_data' => '���ڰ�װ��������',

	'method_undefined' => 'δ���巽��',
	'database_nonexistence' => '���ݿ�������󲻴���',
	'skip_current' => '��������',
	'topic' => 'ר��',

);

$msglang = array(
	'config_nonexistence' => '���� config.inc.php ������, �޷�������װ, ���� FTP �����ļ��ϴ������ԡ�',
);

?>