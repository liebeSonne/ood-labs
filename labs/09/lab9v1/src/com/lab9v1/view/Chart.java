package com.lab9v1.view;

import com.lab9v1.model.DocumentObserver;
import com.lab9v1.model.Harmonica;
import com.lab9v1.model.ImmutableDocument;

import javax.swing.*;
import java.awt.*;

public class Chart extends JPanel implements DocumentObserver {

    int pointSizeX = 80; // сколько пикселей в еденице графика на оси X
    int pointSizeY = 40; // сколько пикселей в еденице графика на оси Y
    private int padding = 15; // отступ для графика, в пикселях
    private int labelPadding = 15; // отступ разметки, в пикселях

    private Color gridColor = new Color(200, 200, 200, 200); // цвет разметки осей
    private Color backgroundColor = Color.WHITE; // цвет фона

    double hatchMarksStepX = 0.5; // шаг черточек на оси X
    double hatchMarksStepY = 1; // шаг черточек на оси Y

    double minX = 0;

    private ImmutableDocument document;
    public Chart(ImmutableDocument document) {
        super();
        this.document = document;
        this.document.register(this);
    }

    public void update() {
        this.paintComponents(this.getGraphics());
    }

    @Override
    public void paintComponents(Graphics g) {
        super.paintComponents(g);

        Graphics2D g2 = (Graphics2D) g;

        this.drawBackground(g2);

        this.document.getHarmonics().forEach(harmonica -> {
            Color color = new Color((int)(Math.random() * 0x1000000));
            g2.setColor(color);
            this.drawHarmonica(g2, harmonica);
        });
    }


    private int getChartXLeft() {
        return padding + labelPadding;
    }

    private int getChartYTop() {
        return padding;
    }

    private int getChartWidth() {
        return getWidth() - (2 * padding) - labelPadding;
    }

    private int getChartHeight() {
        return getHeight() - (2 * padding);
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

    private double getChartX(double x) {
        return this.getChartX0() + x * pointSizeX;
    }

    private double getChartY(double y) {
        return this.getChartY0() + y * pointSizeY;
    }

    private boolean inChartX(double x) {
        return x >= this.getChartMinX() && x <= this.getChartMaxX();
    }

    private boolean inChartY(double y) {
        return y >= this.getChartMinY() && y <= this.getChartMaxY();
    }

    protected int getHatchMarkSizeX() {
        return (int) pointSizeX / 4;
    }

    private void drawBackground(Graphics2D g2) {
        g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);

        int xLeft = this.getChartXLeft();
        int yTop = this.getChartYTop();
        int width = this.getChartWidth();
        int height = this.getChartHeight();

        int minX = this.getChartMinX();
        int maxX = this.getChartMaxX();
        int minY = this.getChartMinY();
        int maxY = this.getChartMaxY();

        Point point0 = new Point(this.getChartX0(), this.getChartY0());

        int hatchMarkSize = this.getHatchMarkSizeX();

        // рисуем фон
        g2.setColor(backgroundColor);
        g2.fillRect(xLeft, yTop, width, height);

        // рисуем ось Y
        g2.setColor(gridColor);
        g2.drawLine(xLeft, yTop, xLeft , maxY);

        // ресуем ось X
        g2.setColor(gridColor);
        g2.drawLine(xLeft, point0.y, maxX , point0.y );

        // рисуем отметки штрихов по оси Y
        g2.setColor(gridColor);
        for (int yi = point0.y; yi <= maxY; yi += pointSizeX) {
            g2.drawLine(xLeft , yi, maxX , yi);
        }
        for (int yi = point0.y; yi >= minY; yi -= pointSizeX) {
            g2.drawLine(xLeft , yi, maxX , yi);
        }

        // рисуем отметки штрихов по оси X
        g2.setColor(gridColor);
        for (int xi = point0.x; xi <= maxX; xi += pointSizeX) {
            g2.drawLine(xi, point0.y - (int) hatchMarkSize / 2, xi, point0.y + (int) hatchMarkSize / 2);
        }
        for (int xi = point0.x; xi >= minX; xi -= pointSizeX) {
            g2.drawLine(xi, point0.y - (int) hatchMarkSize / 2, xi, point0.y + (int) hatchMarkSize / 2);
        }

        // рисуем текст отметок на оси X
        g2.setColor(gridColor);
        double px = 0;
        for (int xi = point0.x; xi <= maxX; xi += pointSizeX / 2, px += hatchMarksStepX) {
            String xLabel = px + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelHeight = metrics.getHeight();
            g2.drawString(xLabel, xi, point0.y + hatchMarkSize / 2 + labelHeight + 5);
        }
        px = 0;
        for (int xi = point0.x; xi >= minX; xi -= pointSizeX / 2, px -= hatchMarksStepX) {
            String xLabel = px + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelHeight = metrics.getHeight();
            g2.drawString(xLabel, xi, point0.y + hatchMarkSize / 2 + labelHeight + 5);
        }

        // рисуем текст отметок на оси Y
        g2.setColor(gridColor);
        int py = 0;
        for (int yi = point0.y; yi <= maxY; yi += pointSizeX, py += hatchMarksStepY) {
            String yLabel = py + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelWidth = metrics.stringWidth(yLabel);
            g2.drawString(yLabel, xLeft - labelWidth - 5, yi);
        }
        py = 0;
        for (int yi = point0.y; yi >= minY; yi -= pointSizeX, py -= hatchMarksStepY) {
            String yLabel = py + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelWidth = metrics.stringWidth(yLabel);
            g2.drawString(yLabel, xLeft - labelWidth - 5, yi);
        }
    }

    private double getMinX() {
        return this.minX;
    }

    private double getMaxX() {
        return (double) this.getChartWidth() / this.pointSizeX;
    }

    private double getMinY() {
        return -1 * ( (double) (this.getChartHeight() / this.pointSizeY / 2));
    }

    private double getMaxY() {
        return (double) (this.getChartHeight() / this.pointSizeY / 2);
    }

    private void drawHarmonica(Graphics2D g2, Harmonica harmonica) {
        double px0 = this.getMinX();
        double py0 = harmonica.execute(px0);
        for (double px = this.getMinX() +0.1; px <= this.getMaxX(); px += 0.1) {
            double py = harmonica.execute(px);
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
