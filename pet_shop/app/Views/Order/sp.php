


<html>
<head>
	<title>senangPay Template</title>
</head>

<body onload="document.order.submit()">
	<!-- This link will head to senangPay Live (not SandBox) -->
	
		<!-- This link will head to senangPay SandBox -->
		<form name="order" method="post" action="https://sandbox.senangpay.my/payment/144163402968178">
			<!-- Do not change the name tag of these inputs!!! -->
			<input type="hidden" name="detail" value="<?= $orders ->order_id ?>">
			<input type="hidden" name="amount" value="<?= $orders ->order_price ?>">
			<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
			<input type="hidden"  name="hash" value="<?= $hashed_string ?>">
			<input type="hidden"  name="name" value="<?= $orders ->recipient_name ?>">      <!-- OPTIONAL -->
			<input type="hidden" name="email" value="<?= $email ?>">    <!-- OPTIONAL -->
			<input  type="hidden" name="phone" value="<?= $orders ->recipient_contact ?>">    <!-- OPTIONAL -->
			<!-- Do not change the name tag of these inputs!!! -->
		</form>
	</body>
	</html>
  