---
title: "Счастливый путь"
description: "Размещайте позитивные сценарии на основном уровне вложенности."
---

Следует стремиться к минимизации глубины вложенности кода и предпочтительно располагать позитивные сценарии выполнения функции без вложенности. Это упрощает чтение и понимание кода, делает его более структурированным и легким для поддержки.


```php
// Плохо ❌

public function myFunction(User $user): void {
    if ($condition) {
     // много кода
    }

    throw new Exception;
}
```

В этом плохом примере позитивный сценарий выполнения функции сразу оказывается внутри условия, а исключение находится в основной части функции. Это делает код сложным для восприятия и усложняет его понимание.


```php
// Хорошо ✅

public function myFunction(User $user): void {
    if (! $condition) {
      throw new Exception;
    }
    
    // много кода
}
```

В хорошем примере мы сначала проверяем условие и только затем желаемое действие. Позитивный сценарий выполнения функции оказывается в основной части функции, что делает код более читабельным и легким для понимания.