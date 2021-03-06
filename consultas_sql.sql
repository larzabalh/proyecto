-- esta consulta muestra el group de gastos
select sum(reg_gastos.importe) as importe, gastos.gasto,fecha
from reg_gastos
join gastos on reg_gastos.gasto_id = gastos.id
group by gastos.gasto


-- esta consulta muestra todo 
select rg.importe as importe, tg.tipo, g.gasto,rg.fecha
from reg_gastos rg
join gastos g on rg.gasto_id = g.id
join tipos_de_gastos tg on g.tipo_de_gasto_id = tg.id


-- Es el periodo actual!!!
select concat(YEAR(CURDATE()),'-',MONTH(CURDATE()))


-- agrupada por tipo
select tg.tipo, tg.id
from reg_gastos rg
join gastos g on rg.gasto_id = g.id
join tipos_de_gastos tg on g.tipo_de_gasto_id = tg.id
group by tg.tipo, tg.id

-- agrupada por gasto
select g.gasto,g.id
from reg_gastos rg
join gastos g on rg.gasto_id = g.id
join tipos_de_gastos tg on g.tipo_de_gasto_id = tg.id
group by g.gasto,g.id

-- 1 agrupada
select rg.importe as importe, tg.tipo, g.gasto
from reg_gastos rg
join gastos g on rg.gasto_id = g.id
join tipos_de_gastos tg on g.tipo_de_gasto_id = tg.id


-- filtrando de año y mes. No le puedo agregar gasto, porque Distinct trae registros unicos
SELECT distinct (concat(year(fecha), '-', month(fecha))) as fecha, rg.importe as importe, tg.tipo, g.gasto
from reg_gastos rg
join gastos g on rg.gasto_id = g.id
join tipos_de_gastos tg on g.tipo_de_gasto_id = tg.id
where year (fecha) = 2018 and month(fecha)=1

select masivo, concat(year(fecha), '-', month(fecha)) as fecha, count(*)
from cta_cte_clientes
where year (fecha) = 2018 and month(fecha)=2 and masivo=1
group by masivo,fecha

select ciudad, count(*)
  from visitantes
  group by ciudad;
  
select clientes.cliente,clientes.id as cliente_id from clientes
union all
select gastos.gasto,gastos.id as gasto_id from gastos
union all
select forma_de_pagos.nombre,forma_de_pagos.id forma_pago_id from forma_de_pagos

-- CREAR UNA VISTA: unir la vista con left join de lo que quiero
create view concepto as 
select id, cliente as concepto from clientes
union
select forma_de_pagos.id, concat(medios.nombre, '-' ,forma_de_pagos.nombre) as concepto from forma_de_pagos
join disponibilidades on forma_de_pagos.disponibilidad_id = disponibilidades.id
join medios on disponibilidades.medio_id = medios.id
union
select id, gasto from gastos
-- con esto selecciono la vista!!!
	select * from concepto

-- operacion matematica
select (debe-haber) as deuda from cta_cte_clientes

select concat(medios.nombre,'-',disponibilidades.nombre)as banco, sum(cta_cte_disponibilidades.debe - cta_cte_disponibilidades.haber) as saldo 
from `cta_cte_disponibilidades` 
inner join `users` on `cta_cte_disponibilidades`.`user_id` = `users`.`id` 
inner join `disponibilidades` on `cta_cte_disponibilidades`.`disponibilidad_id` = `disponibilidades`.`id` 
inner join `medios` on `disponibilidades`.`medio_id` = `medios`.`id` 
where cta_cte_disponibilidades.user_id = '1' 
group by `banco` 
order by `banco` asc

SELECT banco, Suma
FROM
(select concat(medios.nombre,'-',disponibilidades.nombre)as banco, sum(cta_cte_disponibilidades.debe - cta_cte_disponibilidades.haber) as Suma
from `cta_cte_disponibilidades` 
inner join `users` on `cta_cte_disponibilidades`.`user_id` = `users`.`id` 
inner join `disponibilidades` on `cta_cte_disponibilidades`.`disponibilidad_id` = `disponibilidades`.`id` 
inner join `medios` on `disponibilidades`.`medio_id` = `medios`.`id` 
where cta_cte_disponibilidades.user_id = '1' 
group by `banco`) as t
UNION
select concat(medios.nombre,'-',forma_de_pagos.nombre)as banco, sum(reg_gastos.importe) as Suma
from `reg_gastos` 
inner join `gastos` on `reg_gastos`.`gasto_id` = `gastos`.`id` 
inner join `forma_de_pagos` on `reg_gastos`.`forma_de_pagos_id` = `forma_de_pagos`.`id` 
inner join `disponibilidades` on `forma_de_pagos`.`disponibilidad_id` = `disponibilidades`.`id` 
inner join `medios` on `disponibilidades`.`medio_id` = `medios`.`id` 
inner join `tipos_de_gastos` on `gastos`.`tipo_de_gasto_id` = `tipos_de_gastos`.`id` 
inner join `users` on `gastos`.`user_id` = `users`.`id` 
where reg_gastos.pagado is null and  users.id = '1' and year(reg_gastos.fecha) = '2018' and month(reg_gastos.fecha) = '1' 
group by `banco`
GROUP BY banco