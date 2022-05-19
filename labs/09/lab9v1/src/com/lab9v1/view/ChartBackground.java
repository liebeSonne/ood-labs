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
        int xLeft = this.getChartXLeft();
        int yTop = this.getChartYTop();
        int width = this.getChartWidth();
        int height = this.getChartHeight();

        g2.setColor(config.backgroundColor);
        g2.fillRect(xLeft, yTop, width, height);
    }

    private void drawAxisX(Graphics2D g2) {
        int xLeft = this.getChartXLeft();
        Point point0 = new Point(this.getChartX0(), this.getChartY0());
        int maxX = this.getChartMaxX();

        g2.setColor(config.gridColor);
        g2.drawLine(xLeft, point0.y, maxX , point0.y );
    }

    private void drawAxisY(Graphics2D g2) {
        int xLeft = this.getChartXLeft();
        int yTop = this.getChartYTop();
        int maxY = this.getChartMaxY();

        g2.setColor(config.gridColor);
        g2.drawLine(xLeft, yTop, xLeft , maxY);
    }

    private void drawAxisXHatchMark(Graphics2D g2) {
        int minX = this.getChartMinX();
        int maxX = this.getChartMaxX();
        Point point0 = new Point(this.getChartX0(), this.getChartY0());
        int hatchMarkSize = this.getHatchMarkSizeX();

        g2.setColor(config.gridColor);
        for (int xi = point0.x; xi <= maxX; xi += config.pointSizeX) {
            g2.drawLine(xi, point0.y - (int) hatchMarkSize / 2, xi, point0.y + (int) hatchMarkSize / 2);
        }
        for (int xi = point0.x; xi >= minX; xi -= config.pointSizeX) {
            g2.drawLine(xi, point0.y - (int) hatchMarkSize / 2, xi, point0.y + (int) hatchMarkSize / 2);
        }
    }

    private void drawAxisYHatchMark(Graphics2D g2) {
        int xLeft = this.getChartXLeft();
        int maxX = this.getChartMaxX();
        int minY = this.getChartMinY();
        int maxY = this.getChartMaxY();
        Point point0 = new Point(this.getChartX0(), this.getChartY0());

        g2.setColor(config.gridColor);
        for (int yi = point0.y; yi <= maxY; yi += config.pointSizeX) {
            g2.drawLine(xLeft , yi, maxX , yi);
        }
        for (int yi = point0.y; yi >= minY; yi -= config.pointSizeX) {
            g2.drawLine(xLeft , yi, maxX , yi);
        }
    }

    private void drawAxisXText(Graphics2D g2) {
        int minX = this.getChartMinX();
        int maxX = this.getChartMaxX();
        Point point0 = new Point(this.getChartX0(), this.getChartY0());
        int hatchMarkSize = this.getHatchMarkSizeX();

        g2.setColor(config.gridColor);
        double px = 0;
        for (int xi = point0.x; xi <= maxX; xi += config.pointSizeX / 2, px += config.hatchMarksStepX) {
            String xLabel = px + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelHeight = metrics.getHeight();
            g2.drawString(xLabel, xi, point0.y + hatchMarkSize / 2 + labelHeight + 5);
        }
        px = 0;
        for (int xi = point0.x; xi >= minX; xi -= config.pointSizeX / 2, px -= config.hatchMarksStepX) {
            String xLabel = px + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelHeight = metrics.getHeight();
            g2.drawString(xLabel, xi, point0.y + hatchMarkSize / 2 + labelHeight + 5);
        }
    }

    private void drawAxisYText(Graphics2D g2) {
        int xLeft = this.getChartXLeft();
        int minY = this.getChartMinY();
        int maxY = this.getChartMaxY();
        Point point0 = new Point(this.getChartX0(), this.getChartY0());

        g2.setColor(config.gridColor);
        int py = 0;
        for (int yi = point0.y; yi <= maxY; yi += config.pointSizeX, py += config.hatchMarksStepY) {
            String yLabel = py + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelWidth = metrics.stringWidth(yLabel);
            g2.drawString(yLabel, xLeft - labelWidth - 5, yi);
        }
        py = 0;
        for (int yi = point0.y; yi >= minY; yi -= config.pointSizeX, py -= config.hatchMarksStepY) {
            String yLabel = py + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelWidth = metrics.stringWidth(yLabel);
            g2.drawString(yLabel, xLeft - labelWidth - 5, yi);
        }
    }
}
