
        <h2 style="margin-top:0px">Order List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('order/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('order/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('order'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Link Produk</th>
		<th>Nama</th>
		<th>No Whatsapp</th>
		<th>Status</th>
		<th>No Undian</th>
		<th>Tanggal</th>
		<th>Jam</th>
		<th>Tahun</th>
		<th>Action</th>
            </tr><?php
            foreach ($order_data as $order)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $order->link_produk ?></td>
			<td><?php echo $order->nama ?></td>
			<td><?php echo $order->no_whatsapp ?></td>
			<td><?php echo $order->status ?></td>
			<td><?php echo $order->no_undian ?></td>
			<td><?php echo $order->tanggal ?></td>
			<td><?php echo $order->jam ?></td>
			<td><?php echo $order->tahun ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('order/read/'.$order->id_order),'Read'); 
				echo ' | '; 
				echo anchor(site_url('order/update/'.$order->id_order),'Update'); 
				echo ' | '; 
				echo anchor(site_url('order/delete/'.$order->id_order),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    