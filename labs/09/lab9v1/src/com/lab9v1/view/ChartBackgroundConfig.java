package com.lab9v1.view;

import java.awt.*;

public class ChartBackgroundConfig {
    public int pointSizeX = 80; // сколько пикселей в еденице графика на оси X
    public int padding = 15; // отступ для графика, в пикселях
    public int labelPadding = 15; // отступ разметки, в пикселях

    public Color gridColor = new Color(200, 200, 200, 200); // цвет разметки осей
    public Color backgroundColor = Color.WHITE; // цвет фона

    public double hatchMarksStepX = 0.5; // шаг черточек на оси X
    public double hatchMarksStepY = 1; // шаг черточек на оси Y
}
