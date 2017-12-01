-- esta consulta muestra el group de gastos
select sum(reg_gastos.importe) as importe, gastos.gasto
from reg_gastos
join gastos on reg_gastos.gasto_id = gastos.id
group by gastos.gasto


-- esta consulta muestra todo 
select rg.importe as importe, tg.tipo, g.gasto
from reg_gastos rg
join gastos g on rg.gasto_id = g.id
join tipos_de_gastos tg on g.tipo_de_gasto_id = tg.id


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
SELECT distinct (concat(year(fecha), '-', month(fecha)))
FROM finanzas.reg_gastos
where year (fecha) = 2017 and month(fecha)=1