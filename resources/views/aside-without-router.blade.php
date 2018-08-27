<el-aside width="260px" class="main-aside without-router-aside">
	<el-menu default-active="1" class="el-menu">
		<a href="{{ Url('home') }}" class="el-menu-item" index="1">
			<i class="el-icon-document"></i>
			<span>Tableau de bord</span>
		</a>
		<el-submenu index="2">
			<template slot="title">
				<i class="el-icon-location"></i>
				<span>Animaux</span>
			</template>
			<el-menu-item index="2-1"><i class="el-icon-menu"></i>Les petits</el-menu-item>
			<el-menu-item index="2-2"><i class="el-icon-menu"></i>Les parents</el-menu-item>
			<el-menu-item index="2-3"><i class="el-icon-menu"></i>Paires d’élevage</el-menu-item>
		</el-submenu>
		<el-menu-item index="3">
			<i class="el-icon-menu"></i>
			<span>Clients</span>
		</el-menu-item>
		<el-menu-item index="4">
			<i class="el-icon-document"></i>
			<span>Carnet d’adresses</span>
		</el-menu-item>
		<el-menu-item index="5">
			<i class="el-icon-setting"></i>
			<span>Frais d’activité</span>
		</el-menu-item>
		<el-menu-item index="6">
			<i class="el-icon-setting"></i>
			<span>Liste d’attente</span>
		</el-menu-item>
	</el-menu>
</el-aside>
