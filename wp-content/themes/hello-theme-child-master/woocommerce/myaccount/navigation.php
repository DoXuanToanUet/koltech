<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
$icons = [
	'dashboard' =>'<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 483.5 483.5" style="enable-background:new 0 0 512 512" xml:space="preserve" class="hovered-paths"><g>
	<g xmlns="http://www.w3.org/2000/svg">
		<g>
			<path d="M430.75,471.2v-67.8c0-83.9-55-155.2-130.7-179.8c36.4-20.5,61.1-59.5,61.1-104.2c0-65.8-53.6-119.4-119.4-119.4    s-119.4,53.6-119.4,119.4c0,44.7,24.7,83.7,61.1,104.2c-75.8,24.6-130.7,95.9-130.7,179.8v67.8c0,6.8,5.5,12.3,12.3,12.3h353.6    C425.25,483.4,430.75,478,430.75,471.2z M146.75,119.4c0-52.3,42.6-94.9,94.9-94.9s94.9,42.6,94.9,94.9s-42.6,94.9-94.9,94.9    S146.75,171.7,146.75,119.4z M406.25,458.9H77.05v-55.6c0-90.7,73.8-164.6,164.6-164.6s164.6,73.8,164.6,164.6V458.9z" fill="#000000" data-original="#000000" class="hovered-path"></path>
		</g>
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	</g></svg>',
	'coupon-affiliate' =>'<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 489.6 489.6" style="enable-background:new 0 0 512 512" xml:space="preserve"><g>
	<g xmlns="http://www.w3.org/2000/svg">
		<g>
			<path d="M386.8,4.15c-34.1,0-61.8,27.7-61.8,61.8s27.7,61.8,61.8,61.8s61.8-27.7,61.8-61.8S420.9,4.15,386.8,4.15z M386.8,103.25    c-20.6,0-37.3-16.7-37.3-37.3s16.7-37.3,37.3-37.3s37.3,16.7,37.3,37.3S407.4,103.25,386.8,103.25z" fill="#000000" data-original="#000000"></path>
			<path d="M244.8,127.75c34.1,0,61.8-27.7,61.8-61.8s-27.7-61.8-61.8-61.8S183,31.85,183,65.95    C183,100.05,210.7,127.75,244.8,127.75z M244.8,28.65c20.6,0,37.3,16.7,37.3,37.3s-16.7,37.3-37.3,37.3    c-20.6,0-37.3-16.7-37.3-37.3C207.5,45.45,224.2,28.65,244.8,28.65z" fill="#000000" data-original="#000000"></path>
			<path d="M428.3,140.25h-52.6c-6.8,0-12.3,5.5-12.3,12.3s5.5,12.3,12.3,12.3h52.6c20.3,0,36.8,16.5,36.8,36.8v78.3    c0,15.3-9.7,29.2-24.2,34.5c-4.8,1.8-8,6.4-8,11.5v110.6c0,13.4-10.9,24.3-24.3,24.3H353c-6.8,0-12.3,5.5-12.3,12.3    s5.5,12.3,12.3,12.3h55.6c26.9,0,48.8-21.9,48.8-48.8v-103c19.6-10.6,32.2-31.3,32.2-53.9v-78.3    C489.6,167.65,462.1,140.25,428.3,140.25z" fill="#000000" data-original="#000000"></path>
			<path d="M217,485.15h55.6c26.9,0,48.8-21.9,48.8-48.8v-102.7c19.6-10.6,32.2-31.3,32.2-53.9v-78.3c0-33.8-27.5-61.3-61.3-61.3    h-95.1c-33.8,0-61.3,27.5-61.3,61.3v78.3c0,22.6,12.6,43.3,32.2,53.9v102.7C168.2,463.25,190.1,485.15,217,485.15z M160.5,279.75    v-78.3c0-20.3,16.5-36.8,36.8-36.8h95.1c20.3,0,36.8,16.5,36.8,36.8v78.3c0,15.3-9.7,29.2-24.1,34.5c-4.8,1.8-8,6.4-8,11.5v110.6    c0,13.4-10.9,24.3-24.3,24.3h-55.6c-13.4,0-24.3-10.9-24.3-24.3v-110.6c0-5.1-3.2-9.7-8-11.5    C170.2,308.95,160.5,295.05,160.5,279.75z" fill="#000000" data-original="#000000"></path>
			<path d="M164.6,65.95c0-34.1-27.7-61.8-61.8-61.8S41,31.85,41,65.95s27.7,61.8,61.8,61.8C136.8,127.75,164.6,100.05,164.6,65.95z     M65.5,65.95c0-20.5,16.7-37.3,37.3-37.3s37.3,16.7,37.3,37.3s-16.7,37.3-37.3,37.3C82.2,103.25,65.5,86.55,65.5,65.95z" fill="#000000" data-original="#000000"></path>
			<path d="M81,485.15h55.6c6.8,0,12.3-5.5,12.3-12.3s-5.5-12.3-12.3-12.3H81c-13.4,0-24.3-10.9-24.3-24.3v-110.5    c0-5.1-3.2-9.7-8-11.5c-14.4-5.3-24.1-19.1-24.1-34.5v-78.3c0-20.3,16.5-36.8,36.8-36.8h52.4c6.8,0,12.3-5.5,12.3-12.3    s-5.5-12.3-12.3-12.3H61.3c-33.8,0-61.3,27.5-61.3,61.3v78.3c0,22.6,12.6,43.3,32.2,53.9v102.7C32.2,463.25,54.1,485.15,81,485.15    z" fill="#000000" data-original="#000000"></path>
		</g>
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	</g></svg>',
	'edit-account' =>'<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 480 480" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m240 0c-132.546875 0-240 107.453125-240 240s107.453125 240 240 240c7.230469 0 14.433594-.324219 21.601562-.96875 6.664063-.597656 13.269532-1.511719 19.824219-2.65625l2.519531-.445312c121.863282-22.742188 206.359376-134.550782 194.960938-257.996094-11.398438-123.445313-114.9375-217.8945315-238.90625-217.933594zm-19.28125 463.152344h-.566406c-6.222656-.550782-12.398438-1.382813-18.519532-2.449219-.351562-.0625-.703124-.101563-1.046874-.167969-5.984376-1.070312-11.90625-2.398437-17.769532-3.949218l-1.417968-.363282c-5.71875-1.550781-11.375-3.351562-16.949219-5.351562-.578125-.207032-1.160157-.390625-1.738281-.605469-5.464844-2.007813-10.832032-4.257813-16.117188-6.691406-.65625-.292969-1.3125-.574219-1.96875-.886719-5.183594-2.398438-10.265625-5.101562-15.25-7.945312-.703125-.398438-1.414062-.796876-2.117188-1.191407-4.90625-2.863281-9.699218-5.933593-14.402343-9.175781-.710938-.496094-1.429688-.976562-2.136719-1.472656-4.621094-3.277344-9.125-6.757813-13.511719-10.398438l-1.207031-1.054687v-67.449219c.058594-48.578125 39.421875-87.941406 88-88h112c48.578125.058594 87.941406 39.421875 88 88v67.457031l-1.0625.886719c-4.472656 3.734375-9.0625 7.265625-13.777344 10.601562-.625.4375-1.257812.855469-1.878906 1.285157-4.757812 3.304687-9.632812 6.414062-14.625 9.335937-.625.363282-1.265625.707032-1.886719 1.066406-5.058593 2.878907-10.203125 5.597657-15.449219 8.046876-.601562.28125-1.207031.542968-1.816406.800781-5.328125 2.457031-10.742187 4.71875-16.246094 6.742187-.546874.203125-1.097656.378906-1.601562.570313-5.601562 2.007812-11.28125 3.824219-17.03125 5.382812l-1.378906.34375c-5.871094 1.550781-11.796875 2.886719-17.789063 3.960938-.34375.0625-.6875.105469-1.03125.160156-6.128906 1.070313-12.3125 1.902344-18.539062 2.457031h-.566407c-6.398437.550782-12.800781.847656-19.28125.847656-6.480468 0-12.933593-.242187-19.320312-.792968zm179.28125-66.527344v-52.625c-.066406-57.410156-46.589844-103.933594-104-104h-112c-57.410156.066406-103.933594 46.589844-104 104v52.617188c-86.164062-87.941407-85.203125-228.9375 2.148438-315.699219 87.351562-86.757813 228.351562-86.757813 315.703124 0 87.351563 86.761719 88.3125 227.757812 2.148438 315.699219zm0 0" fill="#000000" data-original="#000000"></path><path xmlns="http://www.w3.org/2000/svg" d="m240 64c-44.183594 0-80 35.816406-80 80s35.816406 80 80 80 80-35.816406 80-80c-.046875-44.164062-35.835938-79.953125-80-80zm0 144c-35.347656 0-64-28.652344-64-64s28.652344-64 64-64 64 28.652344 64 64c-.039062 35.328125-28.671875 63.960938-64 64zm0 0" fill="#000000" data-original="#000000"></path></g></svg>',
	'customer-logout' =>'<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 490.2 490.2" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
	<g xmlns="http://www.w3.org/2000/svg">
		<g>
			<path d="M490.2,369.2V121c0-34.2-27.9-62.1-62.1-62.1H227.5c-34.2,0-62.1,27.9-62.1,62.1v40.2c0,6.8,5.5,12.3,12.3,12.3    S190,168,190,161.2V121c0-20.7,16.9-37.6,37.6-37.6h200.5c20.7,0,37.6,16.9,37.6,37.6v248.2c0,20.7-16.9,37.6-37.6,37.6H227.5    c-20.7,0-37.6-16.9-37.6-37.6V329c0-6.8-5.5-12.3-12.3-12.3s-12.3,5.5-12.3,12.3v40.2c0,34.2,27.9,62.1,62.1,62.1h200.7    C462.3,431.3,490.2,403.5,490.2,369.2z" fill="#000000" data-original="#000000" class=""></path>
			<path d="M3.6,253.8l83.9,83.9c2.4,2.4,5.5,3.6,8.7,3.6s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-63-63h229.8    c6.8,0,12.3-5.5,12.3-12.3s-5.5-12.3-12.3-12.3H41.8l63-63c4.8-4.8,4.8-12.5,0-17.3s-12.5-4.8-17.3,0L3.6,236.4    C-1.2,241.2-1.2,249,3.6,253.8z" fill="#000000" data-original="#000000" class=""></path>
		</g>
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	</g></svg>',
	'info-support' =>'<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 490 490" style="enable-background:new 0 0 512 512" xml:space="preserve" class="hovered-paths"><g>
	<g xmlns="http://www.w3.org/2000/svg">
		<g>
			<path d="M401.45,0c-36.1,0-66,26.3-71.9,60.8H27.85c-6.8,0-12.3,5.5-12.3,12.3s5.5,12.3,12.3,12.3h301.6    c5.9,34.4,35.8,60.8,71.9,60.8c40.3,0,73-32.7,73-73S441.65,0,401.45,0z M401.45,121.5c-26.7,0-48.5-21.8-48.5-48.5    s21.8-48.5,48.5-48.5s48.5,21.8,48.5,48.5S428.15,121.5,401.45,121.5z" fill="#000000" data-original="#000000" class="hovered-path"></path>
			<path d="M462.25,232h-301.7c-5.9-34.4-35.8-60.8-71.9-60.8c-40.3,0-73,32.7-73,73s32.8,73,73,73c36.1,0,66-26.3,71.9-60.8h301.6    c6.8,0,12.3-5.5,12.3-12.3C474.45,237.5,468.95,232,462.25,232z M88.65,292.8c-26.7,0-48.5-21.8-48.5-48.5s21.8-48.5,48.5-48.5    s48.5,21.8,48.5,48.5S115.45,292.8,88.65,292.8z" fill="#000000" data-original="#000000" class="hovered-path"></path>
			<path d="M401.45,343.8c-36.1,0-66,26.3-71.9,60.8H27.85c-6.8,0-12.3,5.5-12.3,12.3s5.5,12.3,12.3,12.3h301.6    c5.9,34.4,35.8,60.8,71.9,60.8c40.3,0,73-32.7,73-73S441.65,343.8,401.45,343.8z M401.45,465.3c-26.7,0-48.5-21.8-48.5-48.5    s21.8-48.5,48.5-48.5s48.5,21.8,48.5,48.5S428.15,465.3,401.45,465.3z" fill="#000000" data-original="#000000" class="hovered-path"></path>
		</g>
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	</g></svg>',
	'kol-report' => '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 488.2 488.2" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
	<g xmlns="http://www.w3.org/2000/svg">
		<g>
			<path d="M12.3,220.9c-6.8,0-12.3,5.5-12.3,12.3v229.7c0,6.8,5.5,12.3,12.3,12.3h112.3c6.8,0,12.3-5.5,12.3-12.3V233.2    c0-6.8-5.5-12.3-12.3-12.3H12.3z M112.3,450.6H24.5V245.4h87.8C112.3,245.4,112.3,450.6,112.3,450.6z" fill="#000000" data-original="#000000"></path>
			<path d="M175.7,25.3v437.6c0,6.8,5.5,12.3,12.3,12.3h112.3c6.8,0,12.3-5.5,12.3-12.3V25.3c0-6.8-5.5-12.3-12.3-12.3H187.9    C181.2,13.1,175.7,18.5,175.7,25.3z M200.2,37.6H288v413.1h-87.8L200.2,37.6L200.2,37.6z" fill="#000000" data-original="#000000"></path>
			<path d="M475.9,475.1c6.8,0,12.3-5.5,12.3-12.3V168.1c0-6.8-5.5-12.3-12.3-12.3H363.6c-6.8,0-12.3,5.5-12.3,12.3v294.8    c0,6.8,5.5,12.3,12.3,12.3h112.3V475.1z M375.9,180.4h87.8v270.3h-87.8V180.4z" fill="#000000" data-original="#000000"></path>
		</g>
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	</g></svg>',
	'edit-address' => '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 488.8 488.8" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
	<g xmlns="http://www.w3.org/2000/svg">
		<g>
			<path d="M244.252,97.4c-56.4,0-102.2,45.9-102.2,102.2s45.8,102.3,102.2,102.3s102.2-45.9,102.2-102.2S300.652,97.4,244.252,97.4z     M244.252,277.4c-42.9,0-77.7-34.9-77.7-77.7s34.9-77.7,77.7-77.7s77.7,34.9,77.7,77.7S287.152,277.4,244.252,277.4z" fill="#000000" data-original="#000000"></path>
			<path d="M244.252,0c-2.3,0-4.7,0-7,0.1c-98.6,3.4-180.1,80-189.5,178.1c-1.8,19-0.9,38.1,2.6,56.3c0,0,0.3,2.3,1.4,6.6    c3,13.5,7.5,26.6,13.2,38.8c20.3,48.1,64.8,122.2,161.4,202.4c5.1,4.2,11.5,6.5,18.1,6.5c6.6,0,13-2.3,18.1-6.5    c96.5-80.1,141-154.3,161.2-202c5.8-12.5,10.3-25.7,13.3-39.1c0.6-2.4,1-4.4,1.3-6.3c2.4-12.3,3.6-24.9,3.6-37.5    C441.752,88.6,353.152,0,244.252,0z M414.052,230.7c0,0.2-0.3,1.9-1,5c-2.7,11.8-6.6,23.3-11.8,34.7    c-19.3,45.6-61.7,116.1-154.4,193c-0.9,0.7-1.8,0.9-2.5,0.9c-0.6,0-1.6-0.2-2.5-0.9c-92.7-77-135.2-147.5-154.6-193.4    c-5.1-11-9-22.5-11.7-34.4c-0.6-2.6-0.9-4.2-1-4.7c0-0.2-0.1-0.4-0.1-0.6c-3.1-16.3-3.9-33.1-2.3-49.7c8.3-85.9,79.6-153,166-156    c98.1-3.4,179.1,75.4,179.1,172.9C417.252,208.5,416.152,219.5,414.052,230.7z" fill="#000000" data-original="#000000"></path>
		</g>
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	<g xmlns="http://www.w3.org/2000/svg">
	</g>
	</g></svg>'
];
?>

<nav class="woocommerce-MyAccount-navigation">
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<?php echo $icons[$endpoint] ?>
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
