package com.lab9v1.view;

import javax.swing.*;
import java.awt.*;

public class ChartBackground extends JComponent {
    private final ChartBackgroundConfig config;

    public ChartBackground(ChartBackgroundConfig config) {
        this.config = config;
    }

    @Override
    public void paintComponents(Graphics g) {
        super.paintComponents(g);
        Graphics2D g2 = (Graphics2D) g;

        // рисуем фон
        drawBackground(g2);
        // рисуем ось Y
        drawAxisY(g2);
        // ресуем ось X
        drawAxisX(g2);
        // рисуем отметки штрихов по оси Y
        drawAxisYHatchMark(g2);
        // рисуем отметки штрихов по оси X
        drawAxisXHatchMark(g2);
        // рисуем текст отметок на оси X
        drawAxisXText(g2);
        // рисуем текст отметок на оси Y
        drawAxisYText(g2);
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
        return this.getChartXLeft();
    }

    private int getChartMaxX() {
        return this.getChartXLeft() + this.getChartWidth();
    }

    private int getChartMinY() {
        return this.getChartYTop();
    }

    private int getChartMaxY() {
        return this.getChartYTop() + this.getChartHeight();
    }

    private int getChartX0() {
        return this.getChartMinX();
    }

    private int getChartY0() {
        return this.getChartMinY() + ((int) this.getChartHeight() / 2);
    }

    private int getHatchMarkSizeX() {
        return (int) config.pointSizeX / 4;
    }

    private void drawBackground(Graphics2D g2) {
        int x = getChartXLeft();
        int y = getChartYTop();
        int width = getChartWidth();
        int height = getChartHeight();

        g2.setColor(config.backgroundColor);
        g2.fillRect(x, y, width, height);
    }

    private void drawAxisX(Graphics2D g2) {
        int x1 = getChartXLeft();
        int x2 = getChartMaxX();
        int y = getChartY0();

        g2.setColor(config.gridColor);
        g2.drawLine(x1, y, x2 , y);
    }

    private void drawAxisY(Graphics2D g2) {
        int x = getChartXLeft();
        int y1 = getChartYTop();
        int y2 = getChartMaxY();

        g2.setColor(config.gridColor);
        g2.drawLine(x, y1, x , y2);
    }

    private void drawAxisXHatchMark(Graphics2D g2) {
        int minX = getChartMinX();
        int maxX = getChartMaxX();

        for (int xi = minX; xi <= maxX; xi += config.pointSizeX) {
            drawAxisXHatchMarkLine(g2, xi);
        }
    }

    private void drawAxisXHatchMarkLine(Graphics2D g2, int x) {
        int hatchMarkSize = this.getHatchMarkSizeX();
        int y1 = getChartY0() - (int) hatchMarkSize / 2;
        int y2 = getChartY0() + (int) hatchMarkSize / 2;

        g2.setColor(config.gridColor);
        g2.drawLine(x, y1, x, y2);
    }

    private void drawAxisYHatchMark(Graphics2D g2) {
        int minY = getChartMinY();
        int maxY = getChartMaxY();

        for (int yi = minY; yi <= maxY; yi += config.pointSizeX) {
            drawAxisYHatchMarkLine(g2, yi);
        }
    }

    private void drawAxisYHatchMarkLine(Graphics2D g2, int y) {
        int x1 = getChartXLeft();
        int x2 = getChartMaxX();

        g2.setColor(config.gridColor);
        g2.drawLine(x1 , y, x2 , y);
    }

    private void drawAxisXText(Graphics2D g2) {
        int minX = this.getChartMinX();
        int maxX = this.getChartMaxX();

        double value = 0;
        for (int xi = minX; xi <= maxX; xi += config.pointSizeX / 2, value += config.hatchMarksStepX) {
            drawAxisXTestStr(g2, xi, value);
        }
    }

    private void drawAxisXTestStr(Graphics2D g2, int x, double value) {
        String label = value + "";
        FontMetrics metrics = g2.getFontMetrics();
        int labelHeight = metrics.getHeight();
        int y = getChartY0() + getHatchMarkSizeX() / 2 + labelHeight + 5;

        g2.setColor(config.gridColor);
        g2.drawString(label, x, y);
    }

    private void drawAxisYText(Graphics2D g2) {
        int minY = this.getChartMinY();
        int maxY = this.getChartMaxY();

        double value = 0;
        for (int yi = minY; yi <= maxY; yi += config.pointSizeX, value += config.hatchMarksStepY) {
            drawAxisYTestStr(g2, yi, value);
        }
    }

    private void drawAxisYTestStr(Graphics2D g2, int y, double value) {
        String label = value + "";
        FontMetrics metrics = g2.getFontMetrics();
        int labelWidth = metrics.stringWidth(label);
        int x = getChartXLeft() - labelWidth - 5;

        g2.setColor(config.gridColor);
        g2.drawString(label, x, y);
    }
}
