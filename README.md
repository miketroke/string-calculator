# String Calculator Kata

Una kata clásica de TDD. Implementa la función `add` paso a paso, escribiendo
primero el test y luego el código mínimo para que pase. Refactoriza después de
cada paso.

---

## Paso 1: casos base

```
add(numbers: String): String
```

- Cadena vacía devuelve `"0"`.
- Un único número devuelve el número como String.
- Dos números separados por coma devuelven su suma.

Ejemplos: `""` → `"0"`, `"1"` → `"1"`, `"1.1,2.2"` → `"3.3"`

---

## Paso 2: cantidad arbitraria de números

`add` admite cualquier cantidad de argumentos separados por coma.

---

## Paso 3: salto de línea como separador

El salto de línea (`\n`) también es un separador válido entre comas.

- `"1\n2,3"` → `"6"`
- `"175.2,\n35"` es inválido → `"Number expected but '\n' found at position 6."`

---

## Paso 4: no se puede terminar en separador

- `"1,3,"` es inválido → `"Number expected but EOF found."`

---

## Paso 5: separador personalizado

El input puede comenzar con una línea que define el separador:

```
//[separador]\n[números]
```

- `"//;\n1;2"` → `"3"`
- `"//|\n1|2|3"` → `"6"`
- `"//sep\n2sep3"` → `"5"`
- `"//|\n1|2,3"` es inválido → `"'|' expected but ',' found at position 3."`

Todos los casos anteriores siguen funcionando.

---

## Paso 6: números negativos

- `"-1,2"` → `"Negative not allowed : -1"`
- `"2,-4,-5"` → `"Negative not allowed : -4, -5"`

---

## Paso 7: múltiples errores

Cuando hay más de un error, se devuelven todos separados por `\n`.

- `"-1,,2"` → `"Negative not allowed : -1\nNumber expected but ',' found at position 3."`
- `"-1,,-2"` → `"Negative not allowed : -1\nNumber expected but ',' found at position 3.\nNegative not allowed : -2"`

---

## Paso 8: gestión de errores interna

Introduce una función interna `add` que devuelva un número en lugar de un String
y experimenta con distintas estrategias para propagar los errores:

- Excepciones.
- Tipo `Maybe` / enfoque monádico.
- Código de retorno POSIX con mensaje.
- Tupla con struct de error (estilo Go).

---

## Paso 9: otras operaciones

Implementa `multiply` con las mismas reglas que `add`.

---

## Stack

- PHP 8.1 · PHPUnit 10

## Uso

```bash
make        # construir imagen + instalar dependencias
make test   # ejecutar tests
make shell  # entrar al contenedor
make stop   # parar el contenedor
make clean  # eliminar contenedor y vendor/
```
