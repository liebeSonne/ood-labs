package com.lab9v1.view;

import com.lab9v1.model.UnaryFunction;
import com.lab9v1.model.ImmutableDocument;

import javax.swing.*;
import java.awt.*;

public class ChartHarmonica extends JComponent {
    private final ChartHarmonicaConfig config;
    private final ImmutableDocument document;

    public ChartHarmonica(ChartHarmonicaConfig config, ImmutableDocument document) {
        this.config = config;
        this.document = document;
    }

    @Override
    public void paintComponents(Graphics g) {
        super.paintComponents(g);
        Graphics2D g2 = (Graphics2D) g;

        this.document.getHarmonics().forEach(harmonica -> {
            Color color = new Color((int)(Math.random() * 0x1000000));
            g2.setColor(color);
            this.drawHarmonica(g2, harmonica);
        });
    }

    private int getChartXLeft() {
        return config.padding + config.labelPadding;
    }

    private int getChartYTop() {
        return config.padding;
    }

    private int getChartWidth() {
        return getWidth() - (2 * config.padding) - config.labelPadding;
    }

    private int getChartHeight() {
        return getHeight() - (2 * config.padding);
    }

    private int getChartMinX() {
        return getChartXLeft();
    }

    private int getChartMinY() {
        return getChartYTop();
    }

    private int getChartX0() {
        return getChartMinX();
    }

    private int getChartY0() {
        return getChartMinY() + ((int) getChartHeight() / 2);
    }

    private double getChartX(double x) {
        return getChartX0() + x * config.pointSizeX;
    }

    private double getChartY(double y) {
        return getChartY0() + y * config.pointSizeY;
    }

    private double getMinX() {
        return config.minX;
    }

    private double getMaxX() {
        return (double) getChartWidth() / config.pointSizeX;
    }

    private void drawHarmonica(Graphics2D g2, UnaryFunction harmonica) {
        double px0 = this.getMinX();
        double py0 = harmonica.calculate(px0);
        for (double px = this.getMinX() +0.1; px <= this.getMaxX(); px += 0.1) {
            double py = harmonica.calculate(px);
            int x0 = (int) this.getChartX(px0);
            int y0 = (int) this.getChartY(py0);
            int x = (int) this.getChartX(px);
            int y = (int) this.getChartY(py);
            g2.drawLine(x0, y0, x, y);
            px0 = px;
            py0 = py;
        }
    }
}
