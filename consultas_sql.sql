-- esta consulta muestra el group de gastos
select sum(reg_gastos.importe) as importe, gastos.gasto
from reg_gastos
join gastos on reg_gastos.gasto_id = gastos.id
group by gastos.gasto


-- esta consulta muestra el group de gastos
select sum(reg_gastos.importe) as importe, tipos_de_gastos.tipo
from reg_gastos
join tipos_de_gastos on reg_gastos.gasto_id = tipos_de_gastos.id
group by tipos_de_gastos.tipo

-- porque esta consulta no muestra todos los registros con gasto y tipo asociados?
SELECT reg_gastos.*,gastos.gasto,tipos_de_gastos.tipo
from reg_gastos
join gastos on reg_gastos.gasto_id = gastos.id
join tipos_de_gastos on gastos.id = tipos_de_gastos.id
