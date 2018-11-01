<style type="text/css">
#postdivrich {
	display: none !important;
}
</style>
<form id="frmProduct" method="post" action="#" enctype="multipart/form-data">
	<div>
		<table>
			<tr>
				<th>產品分類</th>
				<td><select>
					<option></option>
					<option>LCD 產業</option>
					<option>SEMICONDUCTOR 產業</option>
					<option>TOUCH PANEL 產業</option>
					<option>LED 產業</option>
					<option>DISK 產業</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>產品名稱</th>
				<td><input type="text" id="txtProductName" name="txtProductName" /></td>
			</tr>
			<tr>
				<th>產品照片</th>
				<td><input type="file" id="filProductImages" name="filProductImages" multiple="false" /></td>
			</tr>
		</table>
	</div>
</form>